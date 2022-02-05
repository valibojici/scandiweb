<script src="./public/js/home.js" defer></script>
<div class="container p-3 my-5">
    <div class="d-flex justify-content-between align-items-center">
        <div class="h2">
            Product List
        </div>
        <div>
            <button id="add-product-btn" class="btn btn-secondary mx-2">ADD</button>
            <button id="delete-product-btn" class="btn btn-secondary mx-2">MASS DELETE</button>
        </div>
    </div>
    <hr>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 m-0 p-0">
            <?php foreach($products as $product) : ?>
                <div class="p-3">
                    <div class=" d-flex flex-column align-items-center border border-3 border-dark square p-4 product-card">
                        <input type="checkbox" class="align-self-start delete-checkbox">
                        
                        <?php foreach($product['info'] as $field_name => $field_val) : ?>
                            <div class="text-center">
                                <span class="<?php echo $field_name ?>">
                                    <?php echo $field_val ?>
                                </span>
                            </div>
                        <?php endforeach ?>
                    
                        <?php foreach($product['properties'] as $field_name => $field_value) : ?>
                            <div class="text-center text-capitalize">
                                <span>
                                    <?php echo $field_name . ":" ?> 
                                </span>
                                <span>
                                    <?php echo $field_value?>
                                </span>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endforeach ?>
    </div>
</div>