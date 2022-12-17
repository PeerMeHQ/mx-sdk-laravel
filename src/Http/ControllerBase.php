<?php

namespace Superciety\ElrondSdk\Http;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ControllerBase extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected int $statusCode = 200;

    protected array $metaData = [];

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function withMeta(array $meta): self
    {
        $this->metaData = $meta;
        return $this;
    }

    public function ok($message = [])
    {
        return $this->setStatusCode(200)->respond($message);
    }

    public function noContent()
    {
        return $this->setStatusCode(204)->respond(null);
    }

    public function invalid($message = [])
    {
        return $this->setStatusCode(400)->respond($message);
    }

    public function unauthenticated($message = ['message' => 'Unauthenticated.'])
    {
        return $this->setStatusCode(401)->respond($message);
    }

    public function forbidden($message = ['message' => 'Forbidden.'])
    {
        return $this->setStatusCode(403)->respond($message);
    }

    public function notFound($message = [])
    {
        return $this->setStatusCode(404)->respond($message);
    }

    public function error(array $errors)
    {
        return $this->setStatusCode(422)->respond(['errors' => $errors], isData: false);
    }

    public function internalServerError($message = [])
    {
        return $this->setStatusCode(500)->respond($message);
    }

    public function respond($response = [], bool $isData = true)
    {
        if ($isData) {
            $response = ['data' => $response];
        }

        if (! empty($this->metaData)) {
            $response['meta'] = $this->metaData;
        }

        return Response::json($response, $this->statusCode);
    }
}
