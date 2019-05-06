<?php 
/*
Template Name: Process page template
*/


wp_head();

echo 'Loading.....';

//print_r($_POST);



$msg = '
	<table width="500">
		<tr>
			<td colspan="2">A new user has sent request for quote. Detail are following.</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>SIGN TYPE : </td>
			<td>'.$_POST['signType'].'</td>
		</tr>
		<tr>
			<td>SIGN MATERIAL : </td>
			<td>'.$_POST['signMaterial'].'</td>
		</tr>
		<tr>
			<td>LETTER TYPE : </td>
			<td>'.$_POST['letterType'].'</td>
		</tr>
		<tr>
			<td>LIGHT TYPE : </td>
			<td>'.$_POST['lightType'].'</td>
		</tr>
		<tr>
			<td>REFERENCE : </td>
			<td>'.$_POST['reference'].'</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><strong>SIZE</strong></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>LENGTH : </td>
			<td>'.$_POST['length'].'</td>
		</tr>
		<tr>
			<td>WIDTH : </td>
			<td>'.$_POST['width'].'</td>
		</tr>
		<tr>
			<td>EMAIL TO SEND QUOTE : </td>
			<td>'.$_POST['email'].'</td>
		</tr>
		<tr>
			<td>MAX. BUDGET : </td>
			<td>'.$_POST['maxbudget'].'</td>
		</tr>
		<tr>
			<td>BUSINESS TYPE : </td>
			<td>'.$_POST['businesstype'].'</td>
		</tr>
	</table>';

	$to = 'muhammadfarooq.pak@gmail.com';
	$subject = 'Quote Request';
	 
	if(wp_mail( $to, $subject, $msg ))
	{
		$url = get_page_link( 20 ).'?status=1';
		header('Location: '.$url);
	}
	else
	{
		$url = get_page_link( 20 ).'?status=0';
		header('Location: '.$url);
	}
?>
