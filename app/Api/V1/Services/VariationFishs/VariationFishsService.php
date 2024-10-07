<?php

namespace App\Api\V1\Services\VariationFishs;

use App\Api\V1\Services\VariationFishs\VariationFishsServiceInterface;
use App\Api\V1\Repositories\VariationFishs\VariationFishsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;

class VariationFishsService implements VariationFishsServiceInterface
{
    use AuthSupport;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;
    
    protected $repository;

    public function __construct(
        VariationFishsRepositoryInterface $repository,
    ){
        $this->repository = $repository;
    }
    
    public function add(Request $request){
		$this->data = $request->validated();	
		try {
			$this->repository->create($this->data);
			return 1;
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return 0;
		}	
    }

	public function edit(Request $request){
        $this->data = $request->validated();
		try {			
			$this->repository->update($this->data['id'], $this->data);
			// Trả về thông báo thành công hoặc dữ liệu đã cập nhật
			return 1;
		} catch (\Exception $e) {
			// Xử lý ngoại lệ nếu cần thiết
			return 0;
		}
    }
	
	public function delete(Request $request){
		$this->data = $request->validated();
        try {
            $this->repository->delete($this->data['id']);
            return 1;
        } catch (\Exception $e) {
            return 0;
        } 
    }
}