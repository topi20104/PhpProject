
<button class="delPostbtn1" data-id="<?php echo $post['postid'] ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Delete post</button>
                        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Are you sure you want to delete this post?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="cancelbtn1" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="delPostbtn" data-bs-dismiss="modal">Delete Post</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                        