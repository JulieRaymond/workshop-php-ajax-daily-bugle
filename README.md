# Atelier Daily Buggle

## Description

You have been recruted by The Daily Buggle to replace the precedent developer who worked on a way to rapidly change the homepage's headline of the website.

Unfortunatly, he did not finish and let the project incomplete...

So now it's your job to fix it ! Your goal: Pick a random headline without reloading the whole page. Then add a menu to search for a headline with specific keywords (still without reload the page).

![delay.jpg](https://i.imgflip.com/5kml2i.jpg)

## To start

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```
4. Import data in your SQL server with the command `php migration.php`;
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.

## Get a random headline without reloading the page

1. First, you have to prepare the server side. Take a look at `routes.php`, you'll see you already have the route `ajax/random/article`. Try it (http://localhost:8000/ajax/random/article). Yes, nothing...

2. To fix it, go to `AjaxController.php` and complete the function `randomArticleJson()`. This function should return the data of a random article in JSON (only one article !). 
* Hint 1 : Take a look at articlesJson() to see how to get articles and return JSON.
* Hint 2 : `array_rand()` can help to select a random element in a array
* Result : If you did right, http://localhost:8000/ajax/random/article should look something like that : 
```
{
  "id": "3",
  "title": "Doctor Octopus holds up another bank !",
  "author": "Peter Parker",
  "picture": "assets/images/article_3.jpg",
  "date": "2021-04-28 00:00:00",
  "content": "[ARTICLE_CONTENT]"
}
```

3. Once the route is ready, let's go to the client side. In `public\assets\js\script.js`, you'll find a `//TODO 1 : Get a random article`, this is the part of the code which will be triggered on the click of the "Change the headline" button. 

This is where you have to work to 1) call the route `ajax/random/article`, 2) get the data of the headline and 3) update the homepage.
* Hint 1 : Use `fetch()` in JS to to call the route (https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch) and manage the response.
* Hint 2 : When you have the data, use the existing function `updateHeadline(title, picture, content)` which will update the DOM page for you.

4. Try it by clicking on the "Change the headline" button. The article should be randomly updated without refresh the page.

## Add a menu to select a headline from specific keywords

1. We now need to be able to select a specific article by a keyword within its title. 
The previous developer started to implement the feature in the div `searchMenu` from `index.html.twig`. He also let a `//TODO 2` in `script.js` to trigger some code when type something in the input.

In `routes.php` there is `ajax/search/articles`. Be careful, this route take one parameter `search` in the query string.
First prepare this route to return all the articles wich contains in the title the word passed in parameter. 

It should look something like that http://localhost:8000/ajax/search/articles?search=spider <= here we search all the articles which contains the word "spider" in their title.

* Hint 1 : You'll need a new method in the `ArticleManager` and use the LIKE keyword in SQL.
* Hint 2 : Your controller should respond an array of article in JSON
* For search 'spider',  it should respond :

```
[
  {
    "id": "1",
    "title": "Spider-Man : Friend or Foe ?",
    "author": "Jonah Jamesson",
    "picture": "assets/images/article_1.jpg",
    "date": "2021-01-18 00:00:00",
    "content": "Cillum enim dolor nostrud irure sint cupidatat esse nulla ipsum proident nisi. Eiusmod reprehenderit aliqua nostrud mollit. Ex ut in ipsum commodo culpa esse ullamco ex. Anim velit et qui non elit pariatur. Non occaecat est veniam aliquip incididunt duis eiusmod irure magna aute. Irure officia consequat est cillum occaecat officia ipsum culpa sint irure pariatur cillum veniam aliqua. Tempor quis veniam aliqua amet magna laborum consectetur laborum laborum do. Sit anim laborum aliquip eu voluptate do aliqua proident. Ex consectetur occaecat in aliqua labore deserunt duis deserunt eiusmod fugiat. Dolor in quis sint consequat occaecat ea aliquip minim proident labore."
  },
  {
    "id": "5",
    "title": "Another Spider-man ? Another criminal",
    "author": "Jonah Jamesson",
    "picture": "assets/images/article_5.jpg",
    "date": "2021-05-23 00:00:00",
    "content": "Minim eiusmod Lorem do exercitation id pariatur non dolore ullamco ea. Magna id veniam eu nulla nostrud velit consectetur ad in fugiat in ea aliqua proident. Ipsum adipisicing minim cupidatat eiusmod aute. Consequat voluptate minim nostrud laboris sunt eiusmod ut ut exercitation qui eiusmod nostrud minim quis. Eu reprehenderit ad eiusmod consequat. Aute pariatur ullamco esse dolor eu eiusmod exercitation do sit amet enim. Cupidatat magna eiusmod fugiat id anim eiusmod consectetur consectetur deserunt tempor esse proident est. Laborum nulla fugiat aliqua elit mollit laboris. Tempor nisi id culpa quis sunt duis in. Ut consectetur incididunt."
  }
]
```


2. Once the route is good, go back in `script.js`. There is another event listener on the input with `id="searchHeadline"`. The event listnened is `input`, which means that the code is call each time you change a character in the input tag. 

Use fetch to get the articles containing the search value in their title, and update the DOM to add these matching titles in `<li>` within the `<ul id="resultList">`.
* HINT : make sure the ul content is resetted between each fetch.
3. Now, make these titles clickables and send to route `/article`
* Hint 1 : Remember to look at the route in `routes.php` to know what this route needs to work.

