<?php

foreach (glob("*.php") as $filename)
{
    include $filename;
}
$bank = 1000;
$game = new NewGame(25);
$game = $game->begin();

echo $game->player->hand[0]->cards[0]->name;
echo $game->player->hand[0]->cards[1]->name;


