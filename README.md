# Bowlkeeper
Bowling Score Manager

## Roadmap

### Games Database
- Leagues
    - ID, Name, Alley, Location, Manager, Asst Manager
- Seasons
    - ID, Name, Start Date, End Date, Day Of Week, Time, Sweeper Date 1, Sweepers Date 2, Sweepers Date 3
- Teams
    - ID, Name
- Players
    - ID, Name
- Games
    - id, Date, Season, Team1, Team2
- Scores
    -id, game, player, f1a, f1b, f2a, f2b, f3a, f3b, f4a, f4b, f5a, f5b, f6a, f6b, f7a, f7b, f8a, f8b, f9a, f9b, f10a, f10b, f10c

- Player Team Relationship (can have multiple entries for each player, even on same team with different start and end dates, only one active record per player/team combo)
    - id, player, team, dateadded, datedeactive, status
- Season League Relationship (Selecting a season in software automatically selects a league)
    -id, season, league
- Average Summaries (possibly write per-game summaries of each players average for that game and their running overall average - Makes less load on server when using widgets / reports)
    - id, playerId, game, gameAverage, seasonAverage, CarrierAverage


A "Game" is comprised of "Scores".  
Each "Game" will have multiple "Scores" records.  
A "Scores" record will reference: Game, Player, Team, Season, League.  
A player can be on multiple teams in the same league but cannot have multiple scores in the same game.

### Main Page (Publicly Visible)
- List players and averages
- List past games and final scores
- Player view
- Game view
- Season view
- League view

### Login Locked Area
#### Tool to Add New Games
- Title the Game
- Select League, Season, and Team
- Autopopulate score entry lines for each player on the team for the selected season
- Buttons:
  - Reload JSON
  - Clear Form (with a warning popup)
  - Write Game to Database (via AJAX to a `.json` file)

#### Tool to Edit Games
- "Game View" page has an edit button that links here, user must be logged in
- Loads up the game into a form similar to "Add Game"
- Saves to .json so you can continue editing later
- Buttons:
  - Reload JSON (continue from another session - editing any field will probably overwrite the other session)
  - Clear Form (with a warning popup)
  - Write Game to Database (via AJAX to a `.json` file)

#### Configuration Page
- Tool to Add Leagues
- Tool to Add Seasons
- Tool to Add Teams
- Tool to Add Players
- Some kind of dynamic styling or page titling, maybe have to make the 0/includes stuff .php files.




# Web Directory
-0 (Includes)
-1 (Images)
-2 (Data)
-3 (PHP Widgets)
-4 (PHP Widget Functions)
-manager (Management Portal)
--addgame (Game Add Tool)
