<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\AuthController;
use App\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use Illuminate\Support\Str;

class _ControlCommon extends BaseController
{

    private $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public function dateFilters()
    {
        $dts = isset($_GET['dts']) ? $_GET['dts'] . ' 00:00:01' : env('START_DATE') . ' 00:00:01';
        $dtf = isset($_GET['dtf']) ? $_GET['dtf'] . ' 23:59:59' : date('Y-m-d H:i:s');
        return [
            'dts' => $dts,
            'dtf' => $dtf
        ];
    }

    public function registersPerPage()
    {
        $pgLimit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        return $pgLimit;
    }

    public function keywordsToSearch($fields)
    {
        $keywords = isset($_GET['q']) ? $_GET['q'] : '';

        $fields = explode(',', $fields);
        $qtdFields = count($fields);

        if (isset($keywords) && $keywords != '') {
            $keywords = explode(' ', $keywords);
            $qtd = count($keywords);
            $search = '';

            for ($i = 0; $i < $qtd; $i++) {
                for ($j = 0; $j < $qtdFields; $j++) {
                    $search .= "($fields[$j] like '%$keywords[$i]%') or ";
                }
            }
            $search = rtrim($search, ' or ');
        }

        return $search;
    }

    public function sortByField()
    {
        $sortField = isset($_GET['sort']) ? $_GET['sort'] : '-id';
        $sinal = substr($sortField, 0, 1);
        $orderBy = ($sinal == '-') ? substr($sortField, 1) . ' DESC' : $sortField . ' ASC';
        return $orderBy;
    }

    public function fieldsToSelect($fieldsPreSelected)
    {
        $fields = isset($_GET['fields']) ? $_GET['fields'] : $fieldsPreSelected;
        $fields = explode(',', $fields);
        return $fields;
    }

    public function customStatusCode($type, $data)
    {
        $status = $data ? 200 : 500;

        if ($type == 'C' && $status == 200) {
            return response('Registro Criado!', 201);
        } else if ($type == 'U' && $status == 200) {
            return response('Registro Alterado!', 200);
        } else if ($type == 'D' && $status == 200) {
            return response('Registro Excluído!', 200);
        } else {
            return response([
                'type' => get_class($this->exception),
                'message' => $this->exception->getMessage()
            ], 500);
        }
    }
}