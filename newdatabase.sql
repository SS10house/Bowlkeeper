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
	"f1a"	INTEGER,
	"f1b"	INTEGER,
	"f1s"	INTEGER,
	"f1score" 	INTEGER DEFAULT 0,
	"f2a"	INTEGER,
	"f2b"	INTEGER,
	"f2s"	INTEGER,
	"f2score" 	INTEGER DEFAULT 0,
	"f3a"	INTEGER,
	"f3b"	INTEGER,
	"f3s"	INTEGER,
	"f3score" 	INTEGER DEFAULT 0,
	"f4a"	INTEGER,
	"f4b"	INTEGER,
	"f4s"	INTEGER,
	"f4score" 	INTEGER DEFAULT 0,
	"f5a"	INTEGER,
	"f5b"	INTEGER,
	"f5s"	INTEGER,
	"f5score" 	INTEGER DEFAULT 0,
	"f6a"	INTEGER,
	"f6b"	INTEGER,
	"f6s"	INTEGER,
	"f6score" 	INTEGER DEFAULT 0,
	"f7a"	INTEGER,
	"f7b"	INTEGER,
	"f7s"	INTEGER,
	"f7score" 	INTEGER DEFAULT 0,
	"f8a"	INTEGER,
	"f8b"	INTEGER,
	"f8s"	INTEGER,
	"f8score" 	INTEGER DEFAULT 0,
	"f9a"	INTEGER,
	"f9b"	INTEGER,
	"f9s"	INTEGER,
	"f9score" 	INTEGER DEFAULT 0,
	"f10a"	INTEGER,
	"f10b"	INTEGER,
	"f10c"	INTEGER,
	"f10as"	INTEGER,
	"f10bs"	INTEGER,
	"f10cs"	INTEGER,
	"f10scorea" 	INTEGER DEFAULT 0,
	"f10scoreb" 	INTEGER DEFAULT 0,
	"f10scorec" 	INTEGER DEFAULT 0,
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




CREATE TRIGGER update_all_scores
AFTER UPDATE OF f1a, f1b, f2a, f2b, f3a, f3b, f4a, f4b, f5a, f5b,
              f6a, f6b, f7a, f7b, f8a, f8b, f9a, f9b, f10a, f10b, f10c
ON Scores
FOR EACH ROW
BEGIN
    -- Update frame 1 score
    UPDATE Scores
    SET f1score = 
        CASE
            WHEN NEW.f1a = 10 THEN 10 + (SELECT COALESCE(f2a, 0) + COALESCE(f2b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f1a + NEW.f1b) = 10 THEN 10 + COALESCE(f2a, 0)
            ELSE NEW.f1a + NEW.f1b
        END
    WHERE id = NEW.id;

    -- Update frame 2 score
    UPDATE Scores
    SET f2score = 
        CASE
            WHEN NEW.f2a = 10 THEN (SELECT f1score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f3a, 0) + COALESCE(f3b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f2a + NEW.f2b) = 10 THEN (SELECT f1score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f3a, 0)
            ELSE (SELECT f1score FROM Scores WHERE id = NEW.id) + NEW.f2a + NEW.f2b
        END
    WHERE id = NEW.id;

    -- Update frame 3 score
    UPDATE Scores
    SET f3score = 
        CASE
            WHEN NEW.f3a = 10 THEN (SELECT f2score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f4a, 0) + COALESCE(f4b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f3a + NEW.f3b) = 10 THEN (SELECT f2score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f4a, 0)
            ELSE (SELECT f2score FROM Scores WHERE id = NEW.id) + NEW.f3a + NEW.f3b
        END
    WHERE id = NEW.id;

    -- Update frame 4 score
    UPDATE Scores
    SET f4score = 
        CASE
            WHEN NEW.f4a = 10 THEN (SELECT f3score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f5a, 0) + COALESCE(f5b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f4a + NEW.f4b) = 10 THEN (SELECT f3score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f5a, 0)
            ELSE (SELECT f3score FROM Scores WHERE id = NEW.id) + NEW.f4a + NEW.f4b
        END
    WHERE id = NEW.id;

    -- Update frame 5 score
    UPDATE Scores
    SET f5score = 
        CASE
            WHEN NEW.f5a = 10 THEN (SELECT f4score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f6a, 0) + COALESCE(f6b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f5a + NEW.f5b) = 10 THEN (SELECT f4score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f6a, 0)
            ELSE (SELECT f4score FROM Scores WHERE id = NEW.id) + NEW.f5a + NEW.f5b
        END
    WHERE id = NEW.id;

    -- Update frame 6 score
    UPDATE Scores
    SET f6score = 
        CASE
            WHEN NEW.f6a = 10 THEN (SELECT f5score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f7a, 0) + COALESCE(f7b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f6a + NEW.f6b) = 10 THEN (SELECT f5score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f7a, 0)
            ELSE (SELECT f5score FROM Scores WHERE id = NEW.id) + NEW.f6a + NEW.f6b
        END
    WHERE id = NEW.id;

    -- Update frame 7 score
    UPDATE Scores
    SET f7score = 
        CASE
            WHEN NEW.f7a = 10 THEN (SELECT f6score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f8a, 0) + COALESCE(f8b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f7a + NEW.f7b) = 10 THEN (SELECT f6score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f8a, 0)
            ELSE (SELECT f6score FROM Scores WHERE id = NEW.id) + NEW.f7a + NEW.f7b
        END
    WHERE id = NEW.id;

    -- Update frame 8 score
    UPDATE Scores
    SET f8score = 
        CASE
            WHEN NEW.f8a = 10 THEN (SELECT f7score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f9a, 0) + COALESCE(f9b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f8a + NEW.f8b) = 10 THEN (SELECT f7score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f9a, 0)
            ELSE (SELECT f7score FROM Scores WHERE id = NEW.id) + NEW.f8a + NEW.f8b
        END
    WHERE id = NEW.id;

    -- Update frame 9 score
    UPDATE Scores
    SET f9score = 
        CASE
            WHEN NEW.f9a = 10 THEN (SELECT f8score FROM Scores WHERE id = NEW.id) + 10 + (SELECT COALESCE(f10a, 0) + COALESCE(f10b, 0) FROM Scores WHERE id = NEW.id)
            WHEN (NEW.f9a + NEW.f9b) = 10 THEN (SELECT f8score FROM Scores WHERE id = NEW.id) + 10 + COALESCE(f10a, 0)
            ELSE (SELECT f8score FROM Scores WHERE id = NEW.id) + NEW.f9a + NEW.f9b
        END
    WHERE id = NEW.id;

    -- Update frame 10 score
    UPDATE Scores
    SET f10scorea = (SELECT f9score FROM Scores WHERE id = NEW.id) + NEW.f10a
    WHERE id = NEW.id;

    -- Handle spare or strike in frame 10
    UPDATE Scores
    SET f10scoreb = 
        CASE
            WHEN NEW.f10a + NEW.f10b = 10 OR NEW.f10a = 10 THEN f10scorea + NEW.f10b
            ELSE f10scorea + NEW.f10b
        END
    WHERE id = NEW.id;

    -- Update final score for frame 10, considering strike or spare
    UPDATE Scores
    SET f10scorec = 
        CASE
            WHEN NEW.f10a + NEW.f10b = 10 OR NEW.f10a = 10 THEN f10scoreb + NEW.f10c
            ELSE f10scoreb + NEW.f10c
        END
    WHERE id = NEW.id;

END;
