<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\Worker;
use Maatwebsite\Excel\Concerns\ToModel;

class WorkerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Post|\Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $post = new Post([
            "worker_id" => $row[0],
            "content" => $row[1],
            "price" => $row[2],
        ]);

        return $post;
    }
}
