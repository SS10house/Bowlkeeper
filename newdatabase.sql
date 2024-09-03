CREATE TABLE AverageSummaries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    player_id INTEGER,
    game_id INTEGER,
    game_average REAL,
    season_average REAL,
    career_average REAL,
    FOREIGN KEY (player_id) REFERENCES Players(id),
    FOREIGN KEY (game_id) REFERENCES Games(id)
)


CREATE TABLE "Games" (
	"id"	INTEGER,
	"date"	DATE NOT NULL,
	"season_id"	INTEGER,
	"team1_id"	INTEGER,
	"team2_id"	INTEGER,
	"week"	INTEGER,
	"name"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("season_id") REFERENCES "Seasons"("id"),
	FOREIGN KEY("team1_id") REFERENCES "Teams"("id"),
	FOREIGN KEY("team2_id") REFERENCES "Teams"("id")
)



CREATE TABLE Leagues (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    alley TEXT,
    location TEXT,
    manager TEXT,
    asst_manager TEXT
)


CREATE TABLE PlayerTeamRel (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    player_id INTEGER,
    team_id INTEGER,
    date_added DATE,
    date_deactive DATE,
    status TEXT,
    FOREIGN KEY (player_id) REFERENCES Players(id),
    FOREIGN KEY (team_id) REFERENCES Teams(id)
)



CREATE TABLE Players (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
)




CREATE TABLE "Scores" (
	"id"	INTEGER,
	"game_id"	INTEGER,
	"player_id"	INTEGER,
	"game_set"	INTEGER,
	"f1a"	INTEGER DEFAULT 0,
	"f1b"	INTEGER DEFAULT 0,
	"f1s"	INTEGER DEFAULT 0,
	"f2a"	INTEGER DEFAULT 0,
	"f2b"	INTEGER DEFAULT 0,
	"f2s"	INTEGER DEFAULT 0,
	"f3a"	INTEGER DEFAULT 0,
	"f3b"	INTEGER DEFAULT 0,
	"f3s"	INTEGER DEFAULT 0,
	"f4a"	INTEGER DEFAULT 0,
	"f4b"	INTEGER DEFAULT 0,
	"f4s"	INTEGER DEFAULT 0,
	"f5a"	INTEGER DEFAULT 0,
	"f5b"	INTEGER DEFAULT 0,
	"f5s"	INTEGER DEFAULT 0,
	"f6a"	INTEGER DEFAULT 0,
	"f6b"	INTEGER DEFAULT 0,
	"f6s"	INTEGER DEFAULT 0,
	"f7a"	INTEGER DEFAULT 0,
	"f7b"	INTEGER DEFAULT 0,
	"f7s"	INTEGER DEFAULT 0,
	"f8a"	INTEGER DEFAULT 0,
	"f8b"	INTEGER DEFAULT 0,
	"f8s"	INTEGER DEFAULT 0,
	"f9a"	INTEGER DEFAULT 0,
	"f9b"	INTEGER DEFAULT 0,
	"f9s"	INTEGER DEFAULT 0,
	"f10a"	INTEGER DEFAULT 0,
	"f10b"	INTEGER DEFAULT 0,
	"f10c"	INTEGER DEFAULT 0,
	"f10as"	INTEGER DEFAULT 0,
	"f10bs"	INTEGER DEFAULT 0,
	"f10cs"	INTEGER DEFAULT 0,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("player_id") REFERENCES "Players"("id"),
	FOREIGN KEY("game_id") REFERENCES "Games"("id")
)


CREATE TABLE Seasons (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    league_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    start_date DATE,
    end_date DATE,
    day_of_week TEXT,
    time TEXT,
    sweeper_date1 DATE,
    sweeper_date2 DATE,
    sweeper_date3 DATE,
    FOREIGN KEY (league_id) REFERENCES Leagues(id)
)


CREATE TABLE Teams (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
)
