<?php
/*
  Name: YooJoon Chang
  Section : CSE 154 AR
  Date: 17th May, 2019

  This file provides my understanding of php by making a small API for my html.

  Web Service details:
  =====================================================================
  Required GET parameters:
  - input
  - this1
  - this2
  - this3
  - this4
  Output formats:
  - Plain text and JSON
  Output Details:
  - If the input parameter is passed and set to "recipes", the API
    will take in the string and return plain text that has information regarding
    the recipes.
  - If the this1 ~ this4 parameters are passed and set to a specific value, an array of
    recipe is returned as JSON.
  - Else outputs 400 error message as plain text.
 */

  /**
   * Part 1: Finish this web service to take a GET parameter called "input"
   * and print out the recipes available stored in the text file.
   */
  if (isset($_GET["input"])) {
    header("Content-type: text/plain");
    $input = $_GET["input"];
    $recipes_count = file("recipe.txt");
    if ($input === "recipes") {
      echo "We have " . count($recipes_count) . " " . $input . " right now:\n";
      foreach ($recipes_count as $food) {
        echo $food;
      }
    }
  } else if (isset($_GET["this1"]) && isset($_GET["this2"]) && isset($_GET["this3"]) && isset($_GET["this4"])) {
    /**
     * Part 2: Finish this web servie to take GET parameters from "this1" to "this4",
     * and returns JSON with a specific set of instructions.
     */
    header("Content-type: application/json");
    $this1 = strtolower($_GET["this1"]);
    $this2 = strtolower($_GET["this2"]);
    $this3 = strtolower($_GET["this3"]);
    $this4 = strtolower($_GET["this4"]);
    $ing_array = array();
    for ($i = 1; $i < 5; $i++) {
      $ing_array[] = strtolower($_GET["this" . $i]);
    }
    if (in_array("scallion", $ing_array) &&
        in_array("honey", $ing_array) &&
        in_array("garlic", $ing_array) &&
        in_array("beef", $ing_array)) {
      bulgogi();
    } else if (in_array("pork", $ing_array) &&
               in_array("hot pepper", $ing_array) &&
               in_array("broth", $ing_array) &&
               in_array("garlic", $ing_array)) {
      broiled_pig();
    } else if (in_array("chocolate chip", $ing_array) &&
               in_array("flour", $ing_array) &&
               in_array("egg", $ing_array) &&
               in_array("butter", $ing_array)) {
      chocolate_chip();
    } else {
      # Some ingredients don't exist or are missing
      header("HTTP/1.1 400 Invalid Request");
      echo "Ingredient does not exist or has less than 4 paremeters.";
    }
  } else {
    # The server isn't working properly or javascript is broken
    header("HTTP/1.1 400 Invalid Request");
    echo "Missing required recipe parameter!";
  }

  # Returns the information about bulgogi
  function bulgogi() {
      $output = array();
      $output["Food"] = "Bulgogi";
      $output["Recipe"] = array(
        "Step 1: Dice garlic and scallion. Prepare chopped onions as well if available.",
        "Step 2: Tenderize beef by marbling them and season them with little bit of pepper and salt.",
        "Step 3: Put it in a ziplock bag and marinate it with diced garlic, scallion, bit of honey, and soy sauce.",
        "Step 4: Cook it once it's fully marinated."
      );
      $output["Image"] = "http://images.bigoven.com/image/upload/t_recipe-256/basic-bulgogi-4b3319.jpg";
      $output["Alt"] = "bulgogi";
      print(json_encode($output));
  }

  # Returns the information about broiled pig
  function broiled_pig() {
      $output = array();
      $output["Food"] = "Broiled pig";
      $output["Recipe"] = array(
        "Step 1: Dice garlic and hot pepper. Prepare chopped onions as well if available.",
        "Step 2: Tenderize the pork by marbling them and season them with little bit of pepper and salt.",
        "Step 3: Preheat oven to 425 degrees.",
        "Step 4: Place the pork with diced condiments and broth, the put it in the oven.",
        "Step 5: Cook for an hour",
        "Step 6: Let it cool for 5 minutes by poking holes in it"
      );
      $output["Image"] = "https://bigoven-res.cloudinary.com/image/upload/t_recipe-256/whole-roast-pig-lechon-asado-1939125.jpg";
      $output["Alt"] = "broiled pig";
      print(json_encode($output));
  }

  # Returns the information about chocolate chip cookies
  function chocolate_chip() {
    $output = array();
    $output["Food"] = "Chocolate chip cookie";
    $output["Recipe"] = array(
      "Step 1: Prepare a bowl and butter it.",
      "Step 2: Add a cup of flour, an egg, a slice of butter, and a teaspoon of vanilla and mix well.",
      "Step 3: Preheat oven to 325 degrees.",
      "Step 4: Add some chocolate chips.",
      "Step 5: Bake for 25 minutes",
      "Step 6: Let it cool for 5 minutes"
    );
    $output["Image"] = "http://images.bigoven.com/image/upload/t_recipe-256/hersheys-chocolate-chip-cookies.jpg";
    $output["Alt"] = "chocolate chip cookie";
    print(json_encode($output));
  }

 ?>
