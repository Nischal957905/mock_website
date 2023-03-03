<?php

namespace App\Services;

use App\Models\Mock;

class MockService{

    public function create($title,$start_date,$end_date){
        $newMock = new Mock;
        $newMock->title = $title;
        $newMock->start_date = $start_date;
        $newMock->end_date = $end_date;
        $newMock->save();
        return $newMock;
    }

    public function list(){
        $mockLists = Mock::select('id','title','start_date','end_date')->get();
        return $mockLists;
    }
}
