
    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron text-right">

        </div>
        <div class="container">

            <div class="main_section">
                <div class="container">
                    <div class="chat_container">
                        <div class="col-sm-3 chat_sidebar">
                            <div class="row">
                                <div id="custom-search-input">
                                    Conversations
                                </div>
                                <div class="member_list">
                                    <ul class="list-unstyled">
                                        <?php $this->load->view('message/show_recivers'); ?>
                                    </ul>
                                </div></div>
                        </div>
                        <!--chat_sidebar-->


                        <div class="col-sm-9 message_section">
                            <div class="row">
                                <div class="chat_area">
                                    <ul class="list-unstyled append_message">
                                    <?php $this->load->view('message/show_messages'); ?>
                                    </ul>
                                </div><!--chat_area-->
                                <?php $this->load->view('message/write_message'); ?>
                            </div>
                        </div> <!--message_section-->
                    </div>
                </div>
            </div>


        </div>
    </div>

