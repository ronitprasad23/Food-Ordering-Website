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
            <h2 class="text-center">Explore Cakes</h2>

        <?php
        // create a sql query to display category from database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        // Execute the query
        $res = mysqli_query($conn, $sql);
        // count rows to check whether the category is available or not
        $count = mysqli_num_rows($res);

        if($count>0)
        {
            // categories available
            while($row=mysqli_fetch_assoc($res))
            {
                // get the values like id, title, image_name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

                ?>

                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        // check whether the image is available or not
                            if($image_name=="")
                            {
                                // Display Message
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                // Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/Category/<?php echo $image_name; ?>" alt="Red Velvet" class="img-responsive img-curve">
                                <?php
                            }

                         ?>
                    

                    <h3 class="float-text text-white">Red Velvet</h3>
                    </div>
                 </a>

                <?php

            }
        }

        ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/watermelon cake.jpg" alt="watermelon cake" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Watermelon cake</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with watermelon and some choclate chips.
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/White cream red Velvet.jpg" alt="White cream red velvet cake" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Red velvet with white cream coated</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with high rich white cream and choclate
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/Red velevt forest.jpg" alt="Red velevt forest" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Red Velevt forest</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Dark choclate and  some Ilaechi
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/Red velvet cake.jpg" alt="Red velvet cake" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>White cream cake</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with high rich white cream and choclate inside.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/Red cherry choclate cake.jpg" alt="Red cherry choclate cake" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Cherry cake</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with cherry and choclate for more taste.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/watermelon cake.jpg" alt="watermelon cake" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Stawbareary cake</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with strawbarery and some vallina.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php
    include('Partials-front/footer.php');
?>