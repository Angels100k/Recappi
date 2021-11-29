<div class="main-container mt-3">
    <div class="row">
        <!-- shoppinglist -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="my-1"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
        </svg>
        <h2 class="text-bold">My shopping list</h2>
    </div>
    <div class="shadow bg-white row">
        <?php
                    while($row = $shoppinglist->fetch()):
                        var_dump($row);
                    endwhile;
                ?>
        <!-- items -->
    </div>

</div>