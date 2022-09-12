<?php
namespace App\Http\Controllers;

use App\Services\MemcacheServiceInterface;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class MemcachedController extends Controller implements MemcachedControllerInterface
{
    public function __construct(private MemcacheServiceInterface $memcacheService)
    {
    }

    public function index(): JsonResponse
    {
        $keys = [0,1,2];
        $values = DB::table('gfcams.customers')->where('customers.city', '=','London')->get()->toArray();

        $this->memcacheService->setValues($values);
        return new JsonResponse(iterator_to_array($this->memcacheService->getValues($keys)));
    }
}
