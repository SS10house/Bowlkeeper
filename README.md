# Bowlkeeper
Bowling Score Manager

## Roadmap

### Games Database
- Leagues
- Seasons
- Teams
- Players
- Games
- Scores

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

#### Tools to Add/Edit Data
- Tool to Add Leagues
- Tool to Add Seasons
- Tool to Add Teams
- Tool to Add Players
- Tool to Edit Games
