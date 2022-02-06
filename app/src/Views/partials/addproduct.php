<script src="./app/public/js/addproduct.js" defer></script>
<div class="container p-3 my-5">
    <div class="d-flex justify-content-between align-items-center">
        <div class="h2">
            Product Add
        </div>
        <div>
            <button id="save-btn" class="btn btn-secondary mx-2">Save</button>
            <button id="cancel-btn" class="btn btn-secondary mx-2">Cancel</button>
        </div>
    </div>
    <hr>
    <div>
        <form action="./add-product" method="post" id="product_form">
            <div class="col col-md-5 col-lg-4 col-xl-3">
                <div class="my-3">
                    <div class="d-flex justify-content-between">
                        <label for="sku">SKU</label>
                        <input required type="text" id="sku" name="sku" value="<?php echo $session['user_sku'] ?? '' ?>">
                    </div>
                    <?php if($session['errors']['sku'] ?? null): ?>
                        <div class="text-danger mx-3"> <?php echo $session['errors']['sku'] ?> </div>
                    <?php endif ?>
                </div>

                <div>
                    <div class="d-flex justify-content-between my-3">
                        <label for="name">Name</label>
                        <input required type="text" id="name" name="name" value="<?php echo $session['user_name'] ?? '' ?>" >
                    </div>
                    <?php if($session['errors']['name'] ?? null): ?>
                        <div class="text-danger mx-3"> <?php echo $session['errors']['name'] ?> </div>
                    <?php endif ?>
                </div>

                <div>
                    <div class="d-flex justify-content-between my-3">
                        <label for="price">Price ($)</label>
                        <input required pattern="\d+.?\d{0,2}" type="text" id="price" name="price" value="<?php echo $session['user_price'] ?? '' ?>">
                    </div>
                    <?php if($session['errors']['price'] ?? null): ?>
                        <div class="text-danger mx-3"> <?php echo $session['errors']['price'] ?> </div>
                    <?php endif ?>
                </div>
            </div>

            <div class="col d-flex my-3 align-items-center">
                <label for="productType" class="me-3">Type switcher</label>
                <select name="type" id="productType" class="p-2">
                    <?php if(!isset($session['user_type'])): ?>
                        <option value="" selected disabled hidden>Choose type</option>
                    <?php endif ?>
                    <?php foreach($productNames as $product): ?>
                        <option 
                            <?php if(($session['user_type'] ?? null) == $product) echo 'selected' ?> 
                            value="<?php echo $product ?>"
                            id = "<?php echo $product ?>">
                            <?php echo $product ?></option>
                    <?php endforeach ?>
                </select>
                <?php if($session['errors']['type'] ?? null): ?>
                    <div class="text-danger mx-3"> <?php echo $session['errors']['type'] ?> </div>
                <?php endif ?>
            </div>
            
            <?php foreach($productNames as $product): ?>
                <div id="<?php echo $product ?>-form" class="my-5 col col-md-5 col-lg-4 col-xl-3 product-type-form d-none">
                    <?php foreach($productFields[$product] as $field): ?>
                        <div class="d-flex justify-content-between my-3">
                            <label class="text-capitalize" for ="<?php echo $field['name'] ?>"> <?php echo $field['name'] ?> (<?php echo $field['unit'] ?>) </label>
                            <input
                                required
                                pattern="\d*"
                                type="text" 
                                id="<?php echo $field['name'] ?>" 
                                name="<?php echo $field['name'] ?>"
                                value="<?php echo $session['user_' . $field['name']] ?? '' ?>" >  
                        </div>
                        <?php if($session['errors'][$field['name']] ?? null): ?>
                            <div class="text-danger"> <?php echo $session['errors'][$field['name']] ?> </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <div>
                        <?php echo $productMessages[$product]?>.
                    </div>
                </div>
            <?php endforeach ?>
        </form>
    </div>
</div>