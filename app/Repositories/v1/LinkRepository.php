<?php

namespace App\Repositories\v1;

use App\Models\Link;
use App\Models\Useraccesses;
use App\Models\Accountant;
use App\Interfaces\v1\LinkInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Illuminate\Support\Str;

class LinkRepository implements LinkInterface
{
    private $model, $commons, $useraccesses, $accountant;

    public function __construct(Link $model, Useraccesses $useraccesses, Accountant $accountant, _ControlCommon $commons)
    {
        $this->model = $model;
        $this->commons = $commons;
        $this->useraccesses = $useraccesses;
        $this->accountant = $accountant;
    }

    public function index()
    {
        $dateFilter = $this->commons->dateFilters();
        $registersPerPage = $this->commons->registersPerPage();
        $fieldsToSelect = $this->commons->fieldsToSelect('links.id,links.uuid,useraccesses.useragent as useragent,accountants.quantity as quantity,links.linkoriginal,links.linkshort,links.identfy,links.slug,links.created_at');
        $sortByField = $this->commons->sortByField();
        $data = $this->model->select($fieldsToSelect)
            ->leftJoin('accountants', 'accountants.link_id', '=', 'links.id')
            ->leftJoin('useraccesses', 'useraccesses.link_id', '=', 'links.id')
            ->whereBetween('links.created_at', [$dateFilter['dts'], $dateFilter['dtf']])
            ->distinct('links.id');

        if (isset($_GET['q'])) {
            $fieldsToSearch = isset($_GET['q']) ? $this->commons->keywordsToSearch('links.linkoriginal,links.id') : '';
            $data->whereRaw("($fieldsToSearch)");
        }

        return $data->orderByRaw($sortByField)->paginate($registersPerPage);
    }

    public function totalClicks()
    {
        $dateFilter = $this->commons->dateFilters();

        $totalClicks = $this->model
            ->leftJoin('accountants', 'accountants.link_id', '=', 'links.id')
            ->whereBetween('links.created_at', [$dateFilter['dts'], $dateFilter['dtf']])
            ->sum('accountants.quantity');

        return [
            'totalClicks' => $totalClicks
        ];

    }

    public function show($uuid)
    {
        $model = $this->model->where('uuid', $uuid)->first();

        $userAccesses = [
            'link_id' => $model->id,
            'ip' => request()->ip(),
            'useragent' => request()->header('User-Agent'),
        ];

        $accountant = $this->accountant->where('link_id', $model->id)->first();

        if ($accountant) {
            $accountant->increment('quantity');
        } else {
            $this->accountant->create([
                'link_id' => $model->id,
                'quantity' => 1,
            ]);
        }

        $this->useraccesses->create($userAccesses);

        return $model;
    }

    public function details($uuid)
    {
        return $this->model->where('uuid', $uuid)->first()->makeHidden(['created_at', 'updated_at', 'deleted_at']);
    }

    public function store($request)
    {
        $dataForm = $request->all();

        if (!isset($dataForm['identfy'])) {
            $dataForm['identfy'] = Str::random(rand(6, 8));
        }

        $slug = ['slug' => Str::slug($dataForm['identfy'], '-')];
        $dataForm = array_merge($dataForm, $slug);

        return $this->model->create($dataForm);
    }

    public function update($uuid, $request)
    {
        $dataForm = $request->all();

        if (!isset($dataForm['identfy'])) {
            $dataForm['identfy'] = Str::random(rand(6, 8));
        }

        $slug = ['slug' => Str::slug($dataForm['identfy'], '-')];
        $dataForm = array_merge($dataForm, $slug);

        return $this->model->where('uuid', $uuid)->update($dataForm);
    }

    public function delete($uuid)
    {
        $model = $this->model->where('uuid', $uuid)->first();
        return $model->delete();
    }

    public function trash()
    {
        $model = $this->model->onlyTrashed()->get();
    }

    public function restore($uuid)
    {
        return $model = $this->model->withTrashed()->where('uuid', $uuid)->restore();
    }
}


// function generateShortCode() {
//     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//     $code = '';
//     $length = 6;

//     for ($i = 0; $i < $length; $i++) {
//         $code .= $characters[rand(0, strlen($characters) - 1)];
//     }

//     return $code;
// }

// // Check if a URL has been submitted
// if (isset($_POST['url'])) {
//     $url = $_POST['url'];

//     // Generate a unique short code
//     $shortCode = generateShortCode();

//     // Insert the original URL and short code into the database
//     $sql = "INSERT INTO urls (url, short_code) VALUES ('$url', '$shortCode')";

//     if ($conn->query($sql) === TRUE) {
//         echo "Short URL: http://yourdomain.com/$shortCode";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// // Check if a short code has been provided
// if (isset($_GET['code'])) {
//     $code = $_GET['code'];

//     // Retrieve the original URL from the database
//     $sql = "SELECT url FROM urls WHERE short_code = '$code'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         $url = $row['url'];
//         header("Location: $url");
//         exit();
//     } else {
//         echo "Short code not found";
//     }
// }