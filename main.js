// Name: YooJoon Chang
// Date: 5/17/2019
// Section: CSE 154 AR
//
// This is main.js javascript file for index.html, which enables
// index.html to react to user input by providing text and pictures for a
// user.
//

(function() {
  "use strict";

  window.addEventListener("load", init);

  /**
   * Initializes the site when the window pops up
   */
  function init() {
    let submitButton = document.getElementById("btn");
    submitButton.addEventListener("click", ingProcess);
    let fetchRecipe = document.getElementById("btn-2");
    fetchRecipe.addEventListener("click", recipeList);
    let backButton = document.getElementById("no-make");
    backButton.addEventListener("click", moveBack);
  }

  /**
   * Shows a recipe made by the user's ingredients
   */
  function ingProcess() {
    let entryBar = document.getElementById("ingredients-entry");
    entryBar.classList.add("hidden");
    let mainPanel = document.getElementById("list-recipe");
    mainPanel.classList.remove("hidden");
    let labels = document.querySelectorAll(".ing");
    let foodArr = [];
    for (let i = 0; i < labels.length; i++) {
      foodArr.push(labels[i].value);
    }
    recipes(foodArr);
  }

  /**
   * queries for a recipe that uses given ingredients
   * @param {array} foodArr - ingredients array placed by the user
   */
  function recipes(foodArr) {
    let recipePhp = "recipe.php?this1=" + foodArr[0] + "&this2=" + foodArr[1] +
                    "&this3=" + foodArr[2] + "&this4=" + foodArr[3];
    fetch(recipePhp)
      .then(checkStatus)
      .then(JSON.parse)
      .then(recipeOption)
      .catch(handleRequestError);
  }

  /**
   * Creates a recipe with instructions and an image for the user
   * @param {object} data - JSON text with the food information
   */
  function recipeOption(data) {
    let availableRecipe = document.getElementById("list-recipe");
    availableRecipe.innerHTML = "";
    let avaRecipe = document.createElement("p");
    avaRecipe.innerText = "You can make " + data["Food"] + " with your ingredients.";
    availableRecipe.appendChild(avaRecipe);
    for (let i = 0; i < data["Recipe"].length; i++) {
      let currentRecipe = document.createElement("p");
      currentRecipe.innerText = data["Recipe"][i];
      availableRecipe.appendChild(currentRecipe);
    }
    let foodImg = document.createElement("img");
    foodImg.src = data["Image"];
    foodImg.alt = data["Alt"];
    availableRecipe.appendChild(foodImg);
  }

  /**
   * Move back to the main
   */
  function moveBack() {
    let entryBar = document.getElementById("ingredients-entry");
    entryBar.classList.remove("hidden");
    let mainPanel = document.getElementById("list-recipe");
    mainPanel.classList.add("hidden");
  }

  /**
   * Queries for recipes
   */
  function recipeList() {
    let recipeListPhp = "recipe.php?input=recipes";
    fetch(recipeListPhp)
      .then(checkStatus)
      .then(giveRecipeList)
      .catch(handleRequestError);
  }

  /**
   * Shows the available recipes to the user for 5 seconds
   * @param {object} data - Text with recipes
   */
  function giveRecipeList(data) {
    let availableRecipe = document.getElementById("list-recipe");
    availableRecipe.classList.remove("hidden");
    availableRecipe.innerHTML = "";
    let recipeList = document.createElement("p");
    recipeList.innerText = data;
    availableRecipe.appendChild(recipeList);
    setTimeout(function() {
      availableRecipe.innerHTML = "";
      availableRecipe.classList.add("hidden");
    }, 5000);
  }

  /**
   * Helper function to return the response's result text if successful, otherwise
   * returns the rejected Promise result with an error status and corresponding text
   * @param {object} response - response to check for success/error
   * @returns {object} - valid result text if response was successful, otherwise rejected
   *                     Promise result
   */
  function checkStatus(response) {
    if (response.status >= 200 && response.status < 300) {
      return response.text();
    } else {
      return Promise.reject(new Error(response.status + ": " + response.statusText));
    }
  }

  /**
   * This function is called when an error occurs in the fetch call chain (e.g. the request
   * returns a non-200 error code, such as when the APOD service is down). Displays a user-friendly
   * error message on the page.
   * @param {Error} err - the err details of the request.
   */
  function handleRequestError(err) {
    let errorTotal = document.getElementById("list-recipe");
    errorTotal.innerHTML = "";
    let theRealError = document.createElement("p");
    theRealError.innerText = err;
    errorTotal.appendChild(theRealError);
    let errorMessage = document.createElement("p");
    errorMessage.innerText = "Server is unavailable, or you put in incorrect/missing parameters.";
    errorTotal.appendChild(errorMessage);
  }

})();
