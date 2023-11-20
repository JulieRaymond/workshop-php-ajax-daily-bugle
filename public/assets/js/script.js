function updateHeadline(title, picture, content) {
  document.getElementById("headlineTitle").innerHTML = title;
  document
    .getElementById("headlinePictureDetails")
    .setAttribute("src", picture);
  document.getElementById("headlineContent").innerHTML = content;
}

document
  .getElementById("changeHeadlineButton")
  .addEventListener("click", function () {
    //TODO 1 : Get a random article
    fetch("http://localhost:8000/api/articles/random")
      .then((response) => response.json())
      .then((data) => {
        updateHeadline(data.title, data.picture, data.content);
      })
      .catch((error) => console.error("Error fetching random article:", error));
  });

document
  .getElementById("searchHeadline")
  .addEventListener("input", function (e) {
    // Here we get the value typed in the input
    let search = e.target.value;
    // TODO 2 : Call the route 'api/articles/search' to get the list
    // of the articles targeted by the search
    fetch(`http://localhost:8000/api/articles/search?search=${search}`)
      .then((response) => response.json())
      .then((data) => {
        // Display the response in the <ul id="resultList">
        const resultList = document.getElementById("resultList");
        resultList.innerHTML = "";

        // Iterate over the matched articles and append clickable titles to the <ul>
        data.forEach((article) => {
          const listItem = document.createElement("li");
          const titleLink = document.createElement("a");
          titleLink.textContent = article.title;
          titleLink.href = `/article?id=${article.id}`;
          titleLink.addEventListener("click", function (event) {
            event.preventDefault();
            // TODO: Handle the click event, e.g., fetch article details and display them
            fetch(`/article/${article.id}`)
              .then((response) => response.json())
              .then((articleDetails) => {
                console.log("Article details:", articleDetails);

                updateHeadline(
                  articleDetails.title,
                  articleDetails.picture,
                  articleDetails.content
                );
              })
              .catch((error) =>
                console.error("Error fetching article details:", error)
              );
          });

          listItem.appendChild(titleLink);
          resultList.appendChild(listItem);
        });
      })
      .catch((error) => console.error("Error fetching search results:", error));
  });
