# reputationloop
reputationloop
My work is actually an ajax based 1 page php website.  It has a front end ( index.php) and an ajax backend ( showreview.php ).
Index.php calls script.js which has an ajax call to showreview.php
Showreview.php has 2 functions.
showdata($data) :
responsible for get json result from api link, and then decode that in an array. Also, it creates the html of reviews to send back to index.php page.
pagination($limit,$adjacents,$rows,$page)
limit: max amount of rows, in this case reviews in 1 page.
adjacents: adjacent page number, from ajax call to refresh the page.
rows: max number of reviews
page: current page.
script.js
it holds jquery function. for many html elements, like #pagination or input boxes like #yelp, #google, #internal etc, it invokes ajax call to showData() function.
it has also a function to show star in .span star element
others are css and images for presentation.
I have used skeleton.js and a responsive background css .thanks to:
http://getskeleton.com/
http://sixrevisions.com/css/responsive-background-image/

