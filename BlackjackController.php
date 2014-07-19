<?php
	
	
	function __autoload($class_name) {
    	include $class_name . '.php';
	}
	
	$bank = 0;
	session_start();
	
	
	if(!isset($_SESSION['cardOrder']))
	{
		$_SESSION['cardOrder'] = array(0,0,10,10,10,10);
	}
	if(!isset($_SESSION['bank']))
	{
		$_SESSION['bank'] = 1000;
	}
	
	$gameId = $_GET['gameId'];
	$action = $_GET['action'];
	$bet = 20;
	
	$response = null;
	
	switch($action)
	{
		case "newGame":
			$_SESSION['bank'] -= $bet;
			$response = BlackjackController::newGame($bet);
			$gameId = $response->gameId;
			break;
		case "hit":
			$response = BlackjackController::hit($gameId);
			break;
		case "stand":
			$response = BlackjackController::stand($gameId);
			break;
		case "double":
			$response = BlackjackController::doubleDown($gameId);
			$_SESSION['bank'] -= $bet;
			break;
		case "split":
			$response = BlackjackController::splitHand($gameId);
			$_SESSION['bank'] -= $bet;
			break;
		case "yesInsurance":
			$response = BlackjackController::insurance($gameId,true);
			$_SESSION['bank'] -= $bet/2;
			break;
		case "noInsurance":
			$response = BlackjackController::insurance($gameId,false);
	}
	
	
	
	?>
	
	<html>
		<body>
		<p>Bank:<?php echo $_SESSION['bank']; ?></p>
		<a href="BlackjackController.php?action=newGame&bet=10">new game (10)</a>
		<?php if($gameId != null ){ ?>
		<a href="BlackjackController.php?action=hit&gameId=<?php echo $gameId ?>">hit</a>
		<a href="BlackjackController.php?action=stand&gameId=<?php echo $gameId ?>">stand</a>
		<a href="BlackjackController.php?action=double&gameId=<?php echo $gameId ?>">double</a>
		<a href="BlackjackController.php?action=split&gameId=<?php echo $gameId ?>">split</a>
		<a href="BlackjackController.php?action=yesInsurance&gameId=<?php echo $gameId ?>">take insurance</a>
		<a href="BlackjackController.php?action=noInsurance&gameId=<?php echo $gameId ?>">deny insurnace</a>
		<?php } ?>
		<pre><?php echo get_class($response).json_encode($response,JSON_PRETTY_PRINT); ?></pre>
		</body>
	</html>
	
	<?php
	
class BlackjackController {

	public static function newGame($bet)
	{
		$gameId = md5(time());
		$game = new NewGame($bet,$gameId);			
		
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
	}

	public static function hit($gameId)
	{
		$game = $_SESSION[$gameId];
		$game = $game->hit();
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
		
	}
	
	public static function stand($gameId)
	{
		$game = $_SESSION[$gameId];
		$game = $game->stick();
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
		
	}
	
	public static function doubleDown($gameId)
	{
		$game = $_SESSION[$gameId];
		$game = $game->double();
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
		
	}
	
	public static function splitHand($gameId)
	{
		$game = $_SESSION[$gameId];
		$game = $game->split();
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
		
	}
	
	public static function insurance($gameId,$insurance)
	{
		$game = $_SESSION[$gameId];
		$game = $game->takeInsurance($insurance);
		$game = self::checkState($game);
		$_SESSION[$gameId] = $game;
		return self::createResponse($game);
		
	}
	
	private static function checkState($game)
	{
		try
		{
		switch(get_class($game))
		{
			case "NewGame":
				//this could return a different state so check again
				return self::checkState($game->begin());
				break;
			case "DealerAction":		
				//this will return an endgame so we need to run the endgame functions
				$game = self::checkState($game->playHand());
				return $game;
				break;
			case "EndGame":
				$game = $game->calculateReturn();
				$_SESSION['bank'] += $game->take;;
				return $game;
				break;
			case "PlayerAction":
				return $game;
				break;
			case "Insurance":
				return $game;
		}
		} 
		catch (exception $e)
		{
			echo $e->message;
			var_dump($game);
		}
	}
	
	private static function createResponse($game)
	{
		return $game;
	}
}
