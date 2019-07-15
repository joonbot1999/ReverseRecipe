# Epic7 API Documentation
The Epic7 API provides information about the characters of the game and their unique assets such as their element, class, multipliers, and more.

## Get a list of all characters in this service.
**Request Format:** epic7.php?character=all

**Request Type:** GET

**Returned Data Format**: JSON

**Description:** Returns a JSON with all of characters' informations. Must be in lowercase

**Example Request:** epic7.php?character=all

**Example Response:**
```
{
    "character 1": {
        "id": "1",
        "name": "Achates",
        "class": "Healer",
        "rarity": "4",
        "element": "Fire",
        "horoscope": "Gemini",
        "s1_mult": "1.00",
        "s2_mult": "0.50",
        "s3_mult": "0.75"
...............................
    "character 10": {
        "id": "10",
        "name": "Sol",
        "class": "Warrior",
        "rarity": "5",
        "element": "Fire",
        "horoscope": "Sagittarius",
        "s1_mult": "1.00",
        "s2_mult": "1.60",
        "s3_mult": "1.60"
    }
}
```

**Error Handling:**
- If missing the `all`, it will 400 error with a helpful message: `"Please provide a valid name for the character."`

## Lookup a character's Information
**Request Format:** epic7.php?character={character}

**Request Type:** GET

**Returned Data Format**: JSON

**Description:** Given a valid character name, it returns a JSON of the character's information. A valid character name includes spaces and is cap sensitive. If there
                 is a space in between string, both strings must start with a capital letter.

**Example Request:** epic7.php?character=Shadow%20Rose

**Example Response:**
```json
{
    "Shadow Rose": {
        "id": "9",
        "name": "Shadow Rose",
        "class": "Knight",
        "rarity": "4",
        "element": "Dark",
        "horoscope": "Gemini",
        "s1_mult": "1.00",
        "s2_mult": "1.60",
        "s3_mult": "0.80"
    }
}
```

**Error Handling:**
- If missing the character name, it will 400 error with a helpful message: `"Please provide a valid name for the character."`

## Add a new character information to the database
- If missing the `all`, it will 400 error with a helpful message: `"Please provide a valid name for the character."`

## Lookup a character's Information
**Request Format:** name:{name}
                    class:{class}
                    rarity:{rarity}
                    element:{element}
                    horoscope:{horoscope}
                    s1_mult:{s1_mult}
                    s2_mult:{s2_mult}
                    s3_mult:{s3_mult}

**Request Type:** POST

**Returned Data Format**: JSON

**Description:** Given a valid set of informations, it adds the informations of a character to the database via json array
                 Name must be a string; Class must be a string; Rarity must be an integer greater than 0; Horoscope must be a string
                 s1_mult, s2_mult, and s3_mult must be floats to the hundredth at maximum(ex: 1.0, 1.05)

**Example Request:**
IN POSTMAN!!!
```
name:Angelica
class:Knight
rarity:4
element:Light
horoscope:Gemini
s1_mult:1.0
s2_mult:2.0
s3_mult:4.35
```
**Example Response after it has been posted:**
```json
{
    "Angelica": {
        "id": "11",
        "name": "Angelica",
        "class": "Knight",
        "rarity": "4",
        "element": "Light",
        "horoscope": "Gemini",
        "s1_mult": "1.00",
        "s2_mult": "2.00",
        "s3_mult": "4.35"
    }
}
```

**Error Handling:**
- If it can't insert the character information, it will 503 error with a helpful message: `"Sorry, I could not insert the character into the database"`
