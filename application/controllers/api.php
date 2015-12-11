<?php

class api extends CI_Controller
{
    /** @var Illuminate\Database\Eloquent\Model */
    public static $model = null;
    
    public function __construct()
    {
        self::$model = rq("model");
    }

    public function listar()
    {
        $col = self::$model->all()->toArray();

        self::response(
            $col
        );
    }

    public function collection()
    {
        $col = self::$model->all()->toArray();

        self::response(
            $col
        );
    }

    public function create()
    {
        $coso = self::$model->firstOrCreate([
            rq()
        ]);

        self::response(
            $coso
        );
    }

    public function update()
    {
        $coso = self::$model->firstOrNew(rq('id'));
        if ($coso->exists) {
            $coso->update();
        } else {

        }

        self::response(
            $coso
        );
    }

    public function delete()
    {
        $coso = self::$model->firstOrNew(rq('id'));
        if ($coso->exists) {
            $coso->update();
        } else {

        }

        self::response(
            $coso
        );
    }


    private static function response($response)
    {
        header('Content-Type: application/json');
        $response['status'] = 'lalala';
        $response['status'] = 'lalala';

        echo json_encode($response);
    }
}
