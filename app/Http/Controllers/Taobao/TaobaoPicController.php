<?php

namespace App\Http\Controllers\Taobao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Taobao\TabPic as TabPic;
use App\Model\Taobao\InfoPic as InfoPic;
use App\Model\Taobao\AllPic as AllPic;

class TaobaoPicController extends Controller
{
	public function setAll(){
		$allValues = json_decode(file_get_contents("http://localhost/selenium-test/test1.php"),true);
		$values = $allValues['module']['dirs']['children'];
		foreach($values as $value){
			if(!AllPic::find($value['id'])){
				$AllPic = new AllPic;
				$AllPic->name = $value['name'];
				$AllPic->id = $value['id'];
				$AllPic->status = "0";
				$AllPic->save();
			}
		}
	}

	public function setPic(){
		ini_set('max_execution_time', 0);
        ini_set("memory_limit", 1048576000);
		$values = AllPic::all();
		foreach($values as $value){
			if($value['status'] == '0'){
				$picvalues = json_decode(file_get_contents("http://localhost/selenium-test/test2.php?cat_id=".$value['id']),true);
				$pics = $picvalues['module']['file_module'];
				foreach($pics as $pic){
					//保存主图
					if(substr($pic['pixel'], 0, 3) == '800'){
						$TabPic = new TabPic;
						$TabPic->id = $value['id'];
						$TabPic->fullUrl = $pic['fullUrl'];
						$TabPic->name = $pic['name'];
						$TabPic->save();
					}
					//保存详情图
					if(substr($pic['pixel'], 0, 3) == '750'){
						$InfoPic = new InfoPic;
						$InfoPic->id = $value['id'];
						$InfoPic->fullUrl = $pic['fullUrl'];
						$InfoPic->name = $pic['name'];
						$InfoPic->save();
					}
				}
				//更新status为"1"
				AllPic::where('id',$value['id'])->update(['status'=> '1']);
			}
		}

	}
	// public function setInfoPic(){
	// 	$values = AllPic::select('id')->get();
	// 	foreach($values as $id){
	// 		$values = json_decode(file_get_contents("http://localhost/selenium-test/test2.php?cat_id=".$id['id']),true);
	// 		$pics = $values['module']['file_module'];
	// 		echo $id['id']."<br>";
	// 		if($pics){
	// 			foreach($pics as $pic){
	// 				if(substr($pic['pixel'], 0, 3) == '750'){
	// 					echo $pic['name'];
	// 					echo "<br>";
	// 					echo $pic['fullUrl'];
	// 					echo "<br>";
	// 					echo $pic['pixel'];
	// 					echo "<br>";
	// 					echo "--------------------";
	// 					echo "<br>";
	// 				}
	// 			}
	// 		}else{
	// 			echo "<br>----------------<br>";
	// 		}
	// 	}
	// }
}
