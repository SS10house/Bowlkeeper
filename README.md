# Bowlkeeper
Bowling Score Manager

## Roadmap

### Games Database
See: newdatabase.sql

Leagues have Seasons
Seasons have Games
Games have Scores

A "Game" is comprised of "Scores".  
Each "Game" will have multiple "Scores" records.  
A "Scores" record will reference: Game, Player, Team,

A player can be on multiple teams in the same league but cannot have multiple score records for the same game.


### Main Page (Publicly Visible)
- List players and averages
- List past games and final scores
- Player view
  - how many open frames you got, strikes you got, splits, your ave and your total series.
- ~~Game view~~
- Season view
- League view

### Login Locked Area
#### Tool to Add New Games
- Title the Game
- Select League, Season, and Team
- Adds record to "Game" table
- Adds records to "Scores" table - one for each associated player in this game

#### Tool to Edit Games
- "Game View" page has an edit button that links here, user must be logged in.
- Loads up the game into a form.
- Saves to .json so you can continue editing later
- Buttons:
  - Reload JSON (continue from another session - editing any field will probably overwrite the other session)
  - Clear Form (with a warning popup)
  - Write Game to Database (via AJAX to a `.json` file)

#### - Calculate Average Tool
No clue, get there, when we get there.

#### Configuration Page
- Tool to Add Leagues
- Tool to Add Seasons
- Tool to Add Teams
- Tool to Add Players
- Some kind of dynamic styling or page titling, maybe have to make the 0/includes stuff .php files.




## Web Directory
- 0 (Includes)
- 1 (Images)
- 2 (Data)
- 3 (PHP Widgets)
- 4 (PHP Widget Functions)
- manager (Management Portal)
-- addgame (Game Add Tool)


