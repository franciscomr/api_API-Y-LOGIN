<?php

namespace App\Http\Resources\Api\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

       
        $relationships = collect();
        foreach($this->collection as $resource){
           // dd(new CompanyResource($resource->company));
           $relationships->push(new CompanyResource($resource->company));
        }
        $companyCollection = new CompanyCollection($relationships->unique());
        $includeArray = explode(",", $request->get('include'));

      
        return [
            'data' => $this->collection,
            'links' => [
                'self' => route('branches.index')
            ],
   
            'included'=> [
               $this->when(in_array('companies',$includeArray),$companyCollection->values()->all())
            ]
        
        ];
    }
}
