<?php  /* Template Name: Todos con ARB*/ 
 ?>
<?php
// stablishing data base connection
include "db.php";
// main vars
include "config.php";

// OUTPUT
include "pre.php";

// selected user info 
//$selected = $_GET['user'];
//$timeline = $_GET['timeline'];
echo "<div id='selected'>";

//if ( $timeline == 'complete' ) {
if ( isset($_GET['timeline']) && $_GET['timeline'] == 'complete' ) {

	$tit = "Timeline";
	echo "<h2 class='tl-tit'>" .$tit. "</h2>";

	$tweets = array();
	$recordset_tl = mysql_query("SELECT * FROM tweets ORDER BY tweets.tw_statusid DESC", $link);
	while ( $row_tl = mysql_fetch_array($recordset_tl) ) {
		$user_id = $row_tl['tw_userid'];
		$recordset_user = mysql_query("SELECT * FROM members WHERE tw_userid = '" .$user_id. "' LIMIT 1", $link);
		while ( $row_user = mysql_fetch_array($recordset_user) ) {
			$user_line = "<div><span class='username'>" .$row_user['tw_username']. "</span> <span class='screenname'>@" .$row_user['tw_screenname']. "</span></div>";
		}
		$tweet = $user_line.$row_tl['tw_status'];
		array_push($tweets, $tweet);
	}
	
	echo "<ul class='user-tweets'>";
	include "tweet.filter.php";
	echo "</ul>";

} elseif ( isset($_GET['channel'])  ) {

	$tit = "Channel #" .$_GET['channel'];
	echo "<h2 class='tl-tit'>" .$tit. "</h2>";


//	foreach ( $et_channels as $channel ) {
//		if ( $_GET['channel'] == $channel ) {
		// if the _GET var is one of set up channels
			
			$tweets = array();
//			$recordset_ht = mysql_query("SELECT * FROM hashtags WHERE tw_hashtag = '" .$channel. "'", $link);
			$recordset_ht = mysql_query("SELECT * FROM hashtags WHERE tw_hashtag = '" .$_GET['channel']. "'", $link);
			while ( $row_ht = mysql_fetch_array($recordset_ht) ) {
				$tweet_id = $row_ht['tw_statusid'];
				$recordset_tl = mysql_query("SELECT * FROM tweets WHERE tw_statusid = '" .$tweet_id. "' ORDER BY tweets.tw_statusid DESC", $link);
				while ( $row_tl = mysql_fetch_array($recordset_tl) ) {
					$user_id = $row_tl['tw_userid'];
					$recordset_user = mysql_query("SELECT * FROM members WHERE tw_userid = '" .$user_id. "' LIMIT 1", $link);
					while ( $row_user = mysql_fetch_array($recordset_user) ) {
						$user_line = "<div><span class='username'>" .$row_user['tw_username']. "</span> <span class='screenname'>@" .$row_user['tw_screenname']. "</span></div>";
					}

					$tweet = $user_line.$row_tl['tw_status'];
					array_push($tweets, $tweet);
				}
			}
			echo "<ul class='user-tweets'>";
			include "tweet.filter.php";
			echo "</ul>";

//		} // end if _GET var is one of set up channels
//	} // end foreach set up channels

//} elseif ( $selected != '' ) {
} elseif ( isset($_GET['user']) ) {
	$selected = $_GET['user'];

	$recordset_user = mysql_query("SELECT * FROM members WHERE tw_screenname = '" .$selected. "' LIMIT 1", $link);
	while ( $row_user = mysql_fetch_array($recordset_user) ) {
		$user_id = $row_user['tw_userid'];
		$user_screenname = $row_user['tw_screenname'];
		$user_avatar = $row_user['tw_useravatar'];
		$user_name = $row_user['tw_username'];
	}

	echo "
	<div id='user-info'>
		<img src='" .$user_avatar. "' alt='" .$user_screenname. " avatar' />
		<div class='member-txt'>
			<div class='member-tit'>
				<h1 class='member-name'>$user_name</h1>
				<span class='member-screen'>@" .$user_screenname. "</span>
			</div>
		</div>
	</div>
	";
	$tweets = array();
	$recordset_tweets = mysql_query("SELECT * FROM tweets WHERE tw_userid ='" .$user_id. "'", $link);
	while ( $row_tweets = mysql_fetch_array($recordset_tweets) ) {
		array_push($tweets, $row_tweets['tw_status']);
//		echo "<li>";
//		echo $row_tweets['tw_status'];
//		echo "</li>";
	}
//echo "<pre>";
//print_r($tweets);
//echo "</pre>";
	echo "<ul class='user-tweets'>";
	include "tweet.filter.php";

//		echo $without_hash;
	echo "</ul>";

} elseif ( !isset($_GET['user']) && !isset($_GET['timeline']) ) {

	echo "
	<div class='meetinfo'>
	<p>A través del menú de la izquierda puedes acceder a la información de cada uno de los asistentes al encuentro Meetcommons.</p>
	<p>La información de cada persona está extraída de twitter: todos los tweets con el hashtag <strong>#meetcommons</strong> se analizan en busca de otros hashtag \"hijos\" que clasifican la información:</p>
	<ul>
		<li><strong>#bio</strong>. Presentación en pocas palabras o usando diferentes hashtags.</li>
		<li><strong>#pasta</strong>. Métodos de financiación.</li>
		<li><strong>#ref</strong>. Referencias (links) relacionadas con tu actividad.</li>
		<li><strong>#col</strong>. Personas con las que se colabora.</li>
		<li><strong>#will</strong>. ¿Con quién te gustaría colaborar?</li>
		<li>Cualquier otro tema.</li>
	</ul>
	</div>
	";

}

echo "</div><!-- end #selected -->";



// members list
echo "<ul id='members-list'>";

$recordset_members = mysql_query("SELECT * FROM members ORDER BY tw_screenname ASC", $link);
while ( $row_members = mysql_fetch_array($recordset_members) ) {
	$user_screenname = $row_members['tw_screenname'];
	$user_avatar = $row_members['tw_useravatar'];
	$user_name = $row_members['tw_username'];
	echo "<li>
		<img src='" .$user_avatar. "' alt='" .$user_screenname. " avatar' />
		<div class='member-txt'>
			<a href='?user=" .$user_screenname. "'>
				<span class='member-name'>$user_name</span>
				<span class='member-screen'>@" .$user_screenname. "</span>
			</a>
		</div>
	</li>
	";
}

echo "</ul>";
// end members list


include "epi.php";
?>
