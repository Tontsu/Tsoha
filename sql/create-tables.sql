CREATE TABLE ominaisuudet(
id serial PRIMARY KEY,
kuvaus varchar UNIQUE CHECK (char_length(kuvaus) > 1)
);

CREATE TABLE kortit(
id serial PRIMARY KEY,
nimi varchar UNIQUE CHECK (char_length(nimi) > 1),
mana integer CHECK (mana >= 0),
hyokkays integer CHECK (hyokkays >= 0),
kesto integer CHECK (kesto > 0)
);

CREATE TABLE kortinOminaisuus (
korttiId integer REFERENCES kortit (id),
ominaisuusId integer REFERENCES ominaisuudet (id)
);

CREATE TABLE kayttajat (
nimi varchar UNIQUE CHECK (char_length(nimi) > 1),
salasana varchar CHECK (char_length(salasana) > 1)
);
