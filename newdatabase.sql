CREATE TABLE Leagues (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    alley TEXT,
    location TEXT,
    manager TEXT,
    asst_manager TEXT
);

CREATE TABLE Seasons (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    start_date DATE,
    end_date DATE,
    day_of_week TEXT,
    time TEXT,
    sweeper_date1 DATE,
    sweeper_date2 DATE,
    sweeper_date3 DATE
);

CREATE TABLE Teams (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE Players (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE Games (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date DATE NOT NULL,
    season_id INTEGER,
    team1_id INTEGER,
    team2_id INTEGER,
    FOREIGN KEY (season_id) REFERENCES Seasons(id),
    FOREIGN KEY (team1_id) REFERENCES Teams(id),
    FOREIGN KEY (team2_id) REFERENCES Teams(id)
);

CREATE TABLE Scores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    game_id INTEGER,
    player_id INTEGER,
    f1a INTEGER, f1b INTEGER, 
    f2a INTEGER, f2b INTEGER,
    f3a INTEGER, f3b INTEGER,
    f4a INTEGER, f4b INTEGER,
    f5a INTEGER, f5b INTEGER,
    f6a INTEGER, f6b INTEGER,
    f7a INTEGER, f7b INTEGER,
    f8a INTEGER, f8b INTEGER,
    f9a INTEGER, f9b INTEGER,
    f10a INTEGER, f10b INTEGER, f10c INTEGER,
    FOREIGN KEY (game_id) REFERENCES Games(id),
    FOREIGN KEY (player_id) REFERENCES Players(id)
);

CREATE TABLE PlayerTeamRel (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    player_id INTEGER,
    team_id INTEGER,
    date_added DATE,
    date_deactive DATE,
    status TEXT,
    FOREIGN KEY (player_id) REFERENCES Players(id),
    FOREIGN KEY (team_id) REFERENCES Teams(id)
);

CREATE TABLE SeasonLeagueRel (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    season_id INTEGER,
    league_id INTEGER,
    FOREIGN KEY (season_id) REFERENCES Seasons(id),
    FOREIGN KEY (league_id) REFERENCES Leagues(id)
);

CREATE TABLE AverageSummaries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    player_id INTEGER,
    game_id INTEGER,
    game_average REAL,
    season_average REAL,
    career_average REAL,
    FOREIGN KEY (player_id) REFERENCES Players(id),
    FOREIGN KEY (game_id) REFERENCES Games(id)
);
