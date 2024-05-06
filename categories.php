<?php
    include('Partials-front/menu.php');
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/Red velevt forest.jpg" alt="Red Velvet" class="img-responsive img-curve">

                <h3 class="float-text text-white">Red Velvet</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/Blackforest.jpg" alt="Blackforest" class="img-responsive img-curve">

                <h3 class="float-text text-white">Blackforest</h3>
            </div>
            </a>

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/Red cherry choclate cake.jpg" alt="Red cherry" class="img-responsive img-curve">

                <h3 class="float-text text-white">Red cherry choclate</h3>
            </div>
            </a>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php
    include('Partials-front/footer.php');
?>