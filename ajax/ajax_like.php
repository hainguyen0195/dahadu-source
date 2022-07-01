<?php 
include "ajax_config.php";

$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;

if(array_key_exists($login_member, $_SESSION) && $_SESSION[$login_member]['active'] == true) {

	$if_tv = $d->rawQueryOne("select liked,id from #_member where id = ? limit 0,1",array($_SESSION[$login_member]['id']));

	if($if_tv['id']!=''){

		$ds_liked[]=array();
		$ds_liked = explode(",", $if_tv['liked']) ;

		if(!in_array($id, $ds_liked)){
			$ds_liked[] = $id;
			$rt= 1; // mới like thành công
		}else{
			$kl=0;
			for ($i=0; $i < count($ds_liked); $i++) { 
				if($ds_liked[$i]==$id){
					$kl=$i;
				}
			}
			unset($ds_liked[$kl]);
			$ds_liked = array_values($ds_liked);
			$rt= 2; // bỏ like thành công
		}
			
			$data['liked'] = implode(',',$ds_liked);
			$d->where('id',$_SESSION[$login_member]['id']);
			$d->update('member',$data);

			echo $rt;
	}
}
