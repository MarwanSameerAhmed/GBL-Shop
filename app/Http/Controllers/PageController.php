<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;
use InvalidArgumentException;

class PageController extends Controller
{
    /**
     * عنوان الـ API الجديد
     */
    private string $apiBase = 'https://gbl-shop-serverside-master-x8lils.laravel.cloud';

    /**
     * يفك تشفير الـ Base64 ID ويتأكد أنه رقم صالح
     *
     * @throws InvalidArgumentException
     */
    private function decodeId(string $encodedId): int
    {
        $decoded = base64_decode($encodedId, true);
        if ($decoded === false || !ctype_digit($decoded)) {
            throw new InvalidArgumentException("معرف غير صالح: {$encodedId}");
        }
        return (int) $decoded;
    }

    /**
     * دالة مساعدة للتواصل مع الـ API
     */
    private function fetch(string $endpoint, array $query = []): array
    {
        try {
            $response = Http::withOptions(['verify' => false])
                            ->throw()
                            ->get("{$this->apiBase}/{$endpoint}", $query);

            return $response->json() ?? [];
        } catch (Throwable $e) {
            session()->flash('error', 'تعذّر جلب البيانات من الـ API.');
            return [];
        }
    }


  public function home()
{
    // جلب اللافتات والصنفوف
    $banners    = $this->fetch('Products', ['limit' => 5]);
    $categories = $this->fetch('Categories');

    // جلب أحدث المنتجات (مثلاً آخر 8)
    $latestProducts = $this->fetch('LastItems');

    return view('home', compact('banners', 'categories', 'latestProducts'));
}



    public function categories()
    {
        $categories = $this->fetch('Categories');
        return view('categories', compact('categories'));
    }


  public function subcategories(string $id)
{

    try {
        $this->decodeId($id);
    } catch (InvalidArgumentException $e) {
        abort(400, $e->getMessage());
    }


    $data = $this->fetch("Categories/{$id}");
    if (empty($data)) {
        abort(404, 'لا توجد بيانات لهذا التصنيف.');
    }


    if (array_key_exists('has_sub_categories', $data[0])) {
        return view('subcategories', [
            'subs' => $data,
            'id'   => $id,
        ]);
    }


    return view('products', [
        'products' => $data,
    ]);
}


    public function products(string $id)
    {
        try {
            $this->decodeId($id);
        } catch (InvalidArgumentException $e) {
            abort(400, $e->getMessage());
        }

        $products = $this->fetch("Items/{$id}");
        return view('products', compact('products'));
    }


   public function productDetails(string $id)
{
    // 1) فك الترميز والتحقق
    try {
        $this->decodeId($id);
    } catch (InvalidArgumentException $e) {
        abort(400, $e->getMessage());
    }

    // 2) جلب البيانات
    $data = $this->fetch("Item/{$id}");

    // 3) تمييز إذا ما كانت النتيجة مصفوفة مُرقّمة أو مُرابطة
    if (isset($data['route']) || isset($data['name'])) {
        // API أعاد العنصر مباشرة كمصفوفة associative
        $product = $data;
    } elseif (isset($data[0]) && is_array($data[0])) {
        // API أعاد قائمة من العناصر
        $product = $data[0];
    } else {
        abort(404, 'المنتج غير موجود.');
    }

    // 4) تأكيديًا، ضعي مفتاح images كمصفوفة حتى لو لم يرسله الـ API
    if (! isset($product['images']) || ! is_array($product['images'])) {
        $product['images'] = ! empty($product['image'])
            ? [ $product['image'] ]
            : [];
    }

    return view('product-details', compact('product'));
}
public function features()
{
    // إذا سبق وحضّرت بيانات لازمة للـ features view ضيفها هنا
    return view('features');
}

public function contact()
{
    return view('contact');
}

    /**
     * تعمل كوسيط لطلبات البحث لتجنب مشاكل CORS
     */
    public function searchProducts(Request $request)
    {
        $query = $request->input('name', '');
        $lang = $request->input('lang', 'ar');

        if (empty($query)) {
            return response()->json([]);
        }

        // استخدم دالة fetch الموجودة أصلاً للتواصل مع الـ API
        $data = $this->fetch('Items/Search', [
            'name' => $query,
            'lang' => $lang
        ]);

        return response()->json($data);
    }

}
