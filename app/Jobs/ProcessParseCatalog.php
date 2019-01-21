<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Product;
use App\Offer;
use App\Category;
class ProcessParseCatalog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = json_decode($this->getNewData('https://markethot.ru/export/bestsp'), true);
        $this->updateCategories($content);
        $this->updateProducts($content);
    }
     public function getNewData($url, $data = []){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, ['query' => $data]);
        $statusCode = $response->getStatusCode();
        return $response->getBody();
    }
    public function updateProducts($content){
        $pids = [];
        $mpids = [];

        foreach($content['products'] as $product){
            $pids[] = $product['id'];
        }

        $mainProducts = Product::whereIn('external_id', $pids)->select('external_id')->get()->toArray();
        foreach($mainProducts as $mainp){
            $mpids[] = $mainp['external_id'];
        }
        foreach($content['products'] as $product){
        if(in_array($product['id'], $mpids)){continue;}
            $productCats = [];

            $productn = new Product;
            $productn->external_id = $product['id'];
            $productn->title = $product['title'];
            $productn->image = $product['image'];
            $productn->description = $product['description'];
            $productn->first_invoice = $product['first_invoice'];
            $productn->url = $product['url'];
            $productn->price = $product['price'];
            $productn->amount = $product['amount'];
            $productn->save();

            foreach($product['categories'] as $category){
                $cat = Category::where('external_id', $category['id'])->first();

                $productn->categories()->save($cat);
            }
            if(isset($product['offers']) && count($product['offers']) > 0 ){
                    foreach($product['offers'] as $offer){
                        $offern = new Offer;
                        $offern->external_id = $offer['id'];
                        $offern->product_id = $productn->id;
                        $offern->price = $offer['price'];
                        $offern->amount = $offer['amount'];
                        $offern->sales = $offer['sales'];
                        $offern->article = $offer['article'];
                        $offern->sales = $offer['sales'];
                        $offern->save();
                    }
            }
        }
    }
    public function updateCategories($content){
        $categories =  [];
        $ids = [];
        $mids = [];
        foreach($content['products'] as $product){
            foreach($product['categories'] as $category){
                $categories[$category['id']] = $category;
                $ids[] = $category['id'];
            }
        }

        $mainCategories = Category::whereIn('external_id', $ids)->select('external_id')->get()->toArray();
        foreach($mainCategories as $mainc){
            $mids[] = $mainc['external_id'];
        }

        foreach($categories as $key=>$value){
            if(in_array($value['id'], $mids)){continue;}

            $category = new Category;
            $category->external_id = $value['id'];
            $category->title = $value['title'];
            $category->alias = $value['alias'];
            $category->parent = $value['parent'];
            $category->save();
        }

    }
}
