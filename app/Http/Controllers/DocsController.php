<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function view(){
        $list = $this->listFiles(base_path() . '/docs');
        return view('docs', compact('list'));
    }

    private function listFiles($path){
        $output = [];
        if(is_file($path)) return $output;

        foreach (scandir($path) as $item){
            if($item[0] === '.' || substr($item, -5) === '.json') continue;

            $item_path = $path . '/' . $item;

            $item_output = [
                'name' => $item,
                'is_dir' => is_dir($item_path),
                'children' => $this->listFiles($item_path),
            ];

            if(!$item_output['is_dir']){
                $item_output['content'] = file_get_contents($item_path);
            }

            $output[] = $item_output;
        }

        return $output;
    }
}
