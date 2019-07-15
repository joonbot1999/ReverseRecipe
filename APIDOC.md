# Recipe API Documentation
Recipe API provides about foods the user can make with their current ingredients.

## Finds all the recipes in the text file
**Request Format:** recipe.php?input=recipes

**Request Type:** GET

**Returned Data Format**: Plain Text

**Description:** Returns a list of all of the recipes stored for the API read from the text file


**Example Request:** recipe.php?input=recipes

**Example Response:**
```
We have 3 recipes right now:
Bulgogi
Broiled pig
Chocolate chip cookie
```

**Error Handling:**
- If missing the `recipes`, it will 400 error with a helpful message: `Missing required recipe parameter!`

## Returns a food the user can make with current ingredients
**Request Format:** recipe.php?this1={ingredient}&this2={ingredient}&this3={ingredient}&this4={ingredient}

**Request Type**: GET

**Returned Data Format**: JSON

**Description:** Given a valie user input, it'll return a JSON of the given recipe with the image source, instructions, and etc.
It only takes in the name of the ingredient for now, so no measurements(explicitly numbers) should be given. The order in which the user inputs
ingredients doesn't matter as long as it's in the API.

**Example Request:** recipe.php?this1=garlic&this2=scallion&this3=beef&this4=honey

**Example Response:**

```json
{
    "Food": "Bulgogi",
    "Recipe": [
        "Step 1: Dice garlic and scallion. Prepare chopped onions as well if available.",
        "Step 2: Tenderize beef by marbling them and season them with little bit of pepper and salt.",
        "Step 3: Put it in a ziplock bag and marinate it with diced garlic, scallion, bit of honey, and soy sauce.",
        "Step 4: Cook it once it's fully marinated."
    ],
    "Image": "http://images.bigoven.com/image/upload/t_recipe-256/basic-bulgogi-4b3319.jpg",
    "Alt": "bulgogi"
}
```

**Error Handling:**
- If it's not taking in 4 parameters or taking in values that doesn't exist in API, it will 400 error with a helpful message: `Ingredient does not exist or has less than 4 paremeters.`