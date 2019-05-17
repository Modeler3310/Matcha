<div class="mask rgba-gradient align-items-center rounded pb-4 mt-5">

    
    <div class="container">
        <div class="row mt-5">
        <div class="col-md-8">
            <form method="post">
            <kbd>sort:</kbd>
                <button class="btn btn-info btn-xs sorting" data-sort='age' name="age_sort">Age</button>
                <button class="btn btn-info btn-xs sorting" data-sort='distance' name="loc_sort">Location</button>
                <button class="btn btn-info btn-xs sorting" data-sort='pop_score' name="rating_sort">Rating</button>
                <button class="btn btn-info btn-xs sorting" data-sort='tags_in_common' name="tag_sort">Match tags</button>
            </form>

        </div>
            <div class="col-md-6 text-md-left">
                
                <br><br>
                <?php $this->load->view('search/show_search_result_js'); ?>
            </div>
            <div class="col-md-6 col-xl-5 mb-4 mt-4">
                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                      <div class="card-body">
                        <div class="text-center ">
                            <p class="bg-danger text-center"><em><?php if (!empty($errors)) echo array_shift($errors); ?></em></p>
                            <h1>
                                <small>Search parameters:</small>
                            </h1>
                            <?php $this->load->view('search/tags_search_form'); ?>
                            <?php $this->load->view('search/search_form'); ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>