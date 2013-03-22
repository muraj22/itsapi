<?
	include('inc.php');
	include('photoprocess.php');
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$siteName?></title>
		<? include('head.php'); ?>
	</head>
	<body>
		<? include('header.php'); ?>
		<div id="main">
			<h2><?='<a href="user.php?username=' . $userProfile['username'] . '">' . $userProfile['firstname'] . ' ' . $userProfile['lastname']?></a>'s Gallery</h2>
<?
				include('login/loginForm.php');
				include('searchResults.php');
				
				if ($loggedIn) {
					if ($currentUser['username'] == $userProfile['username']) {	
?>
			<form action="<? keepUrl(); ?>" method="post" enctype="multipart/form-data">
				<h3>Upload Picture:</h3>
				<label>Title: <input type="text" name="photoTitle"></label>: <input type="file" accept="image/jpeg image/jpg image/JPG" name="photoUpload"><input type="submit" value="Upload Photo">
			</form>
<?
					}
				}
				
				if ($photoExists) {
?>
			<h3 id="photoTitle"><?=$images[$key]['title']?></h3>
			<h4><?=($key + 1) . '/' . (count($images))?></h4>
			<p>Uploaded on <?=date('d/m/y G:i', $images[$key]['date'])?></p>
			<a href="viewPhoto.php?iid=<?=$images[$key]['iid']?>" target="_blank"><img src="viewPhoto.php?iid=<?=$images[$key]['iid']?>&size=<?=$profilePagePictureSize?>" alt="<?=$images[$key]['title']?>"></a>

			<form action="javascript: copyToClipboard('<?=$domain?>/viewPhoto.php?iid=<?=$images[$key]['iid']?>&username=<?=$userProfile['uid']?>#photoTitle')">
				<input type="submit" value="Get image link">
			</form>
<?
					if ($loggedIn) {
						if ($currentUser['uid'] == $userProfile['uid']) {
?>
			<form action="photo.php?iid=<?=$images[$key]['iid']?>" method="post">
				<input type="text" value="<?=$images[$key]['iid']?>" name="profileImage" hidden>
				<input type="submit" value="Set as profile picture" name="setProfile">
			</form>
			<form action="photo.php?iid=<? if ($prev != $images[$key]['iid']) { echo $prev; } else { echo $next; }?>" method="post">
				<input type="text" value="<?=$images[$key]['iid']?>" name="profileImage" hidden>
				<input type="submit" value="Delete" name="deleteImage">
			</form>
<?
						}
					}
					if ($prev != $images[$key]['iid']) {
?>
			<form action="<?=keepUrl()?>#photoTitle" method="get">
				<input type="text" value="<?=$prev?>" name="iid" hidden>
<?
						if (!$loggedIn || ($userProfile != $currentUser)) {
							echo "<input type=\"text\" value=\"{$userProfile['username']}\" name=\"username\" hidden>";
						}
?>
				<input type="submit" value="Previous">
			</form>
<?
					}
					if ($next != $images[$key]['iid']) {
?>
			<form action="<?=keepUrl()?>#photoTitle" method="get">
				<input type="text" value="<?=$next?>" name="iid" hidden>
<?
						if (!$loggedIn || ($userProfile != $currentUser)) {
							echo "<input type=\"text\" value=\"{$userProfile['username']}\" name=\"username\" hidden>";
						}
?>
				<input type="submit" value="Next">
			</form>
<?
					}
				}
?>
		</div>
		<?
			include('footer.php');
		?>
	</body>
</html>
