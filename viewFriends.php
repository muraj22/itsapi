<?
	include 'inc.php';

	friends($mysqli, $currentUser, "<a href=\"user.php?username={username}\">{firstname} {lastname}</a><form action=\"javascript: formActionValues('deleteFriend.php', ['deleteFriend'], ['{fid}'], ''); formAction('viewFriends.php', ['viewFriends'], 'friendsList');\" style=\"display: inline\"><input type=\"text\" id=\"deleteFriend\" value=\"{fid}\" hidden=\"yes\"><input type=\"text\" name=\"viewFriends\" value=\"{$viewFriendsButtonTxt}\" hidden=\"yes\"><input type=\"submit\" value=\"delete\"></form>", 'friendsBar');