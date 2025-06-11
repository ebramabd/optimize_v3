<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait Crud
{
    public function save( $model ,  $data ,  $id = null )
    {
        if ($id != null){
            $object = $this->getOneObject($model , 'id' , $id) ;
            if ($object === null){
                return null;
            }
            $object->update($data) ;
            return  $object;
        }
        $object = $model->create($data);
        if (!$object){
            return null;
        }
        return $object;
    }

    public function getAllObject($model)
    {
        return $model->get();
    }

    public function getOneObject($model , $key , $value)
    {
        $tableName = $model->getTable() ;
        $columns = Schema::getColumnListing($tableName);
        if (!in_array($key ,$columns ) ){
            return null ;
        }
        $object = $model->where($key , $value)->first();
        if (!$object){
            return null ;
        }
        return $object ;
    }

    public function delete($model , $id)
    {
        $object = $this->getOneObject($model , 'id' , $id) ;
        if ($object == null) {
            return null ;
        }
        $object->delete();
        return true ;
    }

}
