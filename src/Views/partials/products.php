<div class="row">
    <?php foreach($products as $product) : ?>
        <div class="border-3 text-center square m-2 p-2 position-relative col-3 card">
            <?php foreach($product['info'] as $field_name => $field_val) : ?>
                <div>
                    <span>
                        <?php echo $field_name ?> 
                    </span>
                    <span>
                        <?php echo $field_val ?>
                    </span>
                </div>
            <?php endforeach ?>
        
        
            <?php foreach($product['properties'] as $field_name => $field_val) : ?>
                <div>
                    <span>
                        <?php echo $field_name ?> 
                    </span>
                    <span>
                        <?php echo $field_val ?>
                    </span>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>