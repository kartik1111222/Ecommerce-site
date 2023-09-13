<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('image')->get();
        // dd($items);
        
        // foreach($items as $item){
       
        //     $data = $items->image->images;
        // }
        // // dd($data);
        // $image = explode(",", $data);
        // dd($image[0]);
       
        return view('seller.product.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(Item::with(['images'])->find(1));
        return view('seller.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        

        $item = new Item();
        $item->name = $data['name'];
        $item->item_type = $data['item_type'];
        $item->shape = $data['shape'];
        $item->price = $data['price'];
        $item->description = $data['description'];
        $item->length = $data['length'];
        $item->width = $data['width'];
        $item->depth = $data['depth'];
        $item->save();
        $id = $item->id;

        

        $image_data = [];
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $name = time() . rand(1, 100) . '.' . $image->extension();
                $path = public_path() . '/assets/images/items';
                $image->move($path, $name);
                $image_data[] = $name;
            }
        }

        $image = new Image();
        $image->images =  implode(",", $image_data);
        $image->item_id = $id;
        $image->save();
        return response()->json([
                'message' => 'Item added successfully!'
        ]);





        // dd($image);

        // $hotelImages = $request->file('images', []);
        // foreach ($hotelImages as $image) {
        //     $ext = $image->extension();
        //     $imageName = date('YmdHis') . '_' . uniqid() . '.' . $ext;

        //     $image->move(storage_path('app/public/hotel_image/'), $imageName);

           
        // }
        // $hotelPhoto = new Image();
        // $hotelPhoto->item_id = $id;
        // $hotelPhoto->images = $imageName;
        // $hotelPhoto->save();
        // return response()->json([
        //     'message' => 'Item added successfully!'
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Item::find($id);
        return view('seller.product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $item = Item::find($id);
        $item->name = $data['name'];
        $item->item_type = $data['item_type'];
        $item->shape = $data['shape'];
        $item->price = $data['price'];
        $item->description = $data['description'];
        $item->length = $data['length'];
        $item->width = $data['width'];
        $item->depth = $data['depth'];
        if ($request->has('image')) {
            $image = $request->image;
            $name = time() . '.' . $image->extension();
            $path = public_path() . '/assets/images/items';
            $image->move($path, $name);
            $item->image = $name;
        }
        $item->save();
        return response()->json([
            'message' => 'Item updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if ($item != null) {
            $item->delete();
            return redirect()->route('seller.product.index');
        }
    }
}
