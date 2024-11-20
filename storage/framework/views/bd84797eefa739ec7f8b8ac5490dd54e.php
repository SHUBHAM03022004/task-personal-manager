<title>Notepad - Personal Task Manager </title>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="main-content"> 
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header" style=" color:black">   
                     <h4>Notepad                                     
                    <button type="button" style="float:right" class="btn btn-primary"data-toggle="modal" data-target="#exampleModal">
                        +Add
                    </button></h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Details</th>
                                <!-- <th class="text-center">Links</th> -->
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $__currentLoopData = $mynotepaddata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->id_note); ?></td>
                                <td><?php echo e($value->title_note); ?></td>
                                <td ><textarea readonly rows="1" cols="100"><?php echo e($value->details_note); ?></textarea></td>
                                <td class="text-center">
                                    <button type="button" onclick="getDatafromDB('<?php echo e($value->id_note); ?>')" data-id="<?php echo e($value->id_note); ?>" style="background:none;border:none" data-toggle="modal" data-target="#exampleModal2">
                                    <?php if($value->status_note == '1'): ?>
                                        <span class="badge bg-success">Active</span>
                                        <?php elseif($value->status_note == '2'): ?>
                                        <span class="badge bg-info">Slow Down</span>                                
                                        <?php elseif($value->status_note == '3'): ?>
                                        <span class="badge bg-info">Complete</span>                                
                                        <?php elseif($value->status_note == '3'): ?>
                                        <span class="badge bg-info">Complete</span>                                
                                        <?php elseif($value->status_note == '4'): ?>
                                        <span class="badge bg-info">Urgent</span>                                
                                    <?php else: ?>
                                        <span class="badge bg-danger">Deactive</span>                                
                                    <?php endif; ?>
                                    </button>
                                <!--   
                                    <a href="/works/<?php echo e($value->id_note); ?>"><button class="btn btn-info">Details</button></a>-->
                                </td>
                                <td class="text-center"><button type="button" onclick="DeleteDatafromDB('<?php echo e($value->id_note); ?>')" data-id="<?php echo e($value->id_note); ?>" class="btn btn-danger">
                                        Delete</button>
                                </td> 
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

     
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Notepad</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="/add/notepaddata" method="POST" >
                <?php echo csrf_field(); ?>
                <label for="title_note">Title</label>
                <input type="text" id="title_note" name="title_note" class="form-control" required>
                <label for="details_note">Details</label>
                <textarea id="details_note" name="details_note" class="form-control" rows="4" cols="50"></textarea>
                <label for="status_note">Status</label>
                <select id="status_note" name="status_note" class="form-control" required>
                    <option value="">Choose</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    <option value="2">Slow Down</option>
                    <option value="3">Complete</option>
                    <option value="4">Urgent</option>
                </select>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="added">Save</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <!--  -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form action="/edit/notepaddata" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id_note" id="getid_note">
                <!-- <label for="title">Title</label> -->
                <input type="hidden" id="gettitle_note" name="title_note" class="form-control" required>
                <!-- <label for="email_note">Email</label> -->
                <input type="hidden" id="getdetails_note" name="details_note" class="form-control" required>
                <select id="getstatus_note" name="status_note" class="form-control" required>
                    <option value="">Choose</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                    <option value="2">Slow Down</option>
                    <option value="3">Complete</option>
                    <option value="4">Urgent</option>
                </select>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updated">Update</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<script>
  $('#added').click(function()
    {swal({
             title:'Saved',
             icon:'success',
             text:'New Notepad Added...!',
            });
    }
  )
        // Get for edit.
        function getDatafromDB(value){
         const xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            let res = JSON.parse(this.responseText);
            console.log(this.responseText);
            console.log(res);
            res = res[0];
            document.getElementById('getid_note').value = res.id_note;
            document.getElementById('gettitle_note').value = res.title_note;
            document.getElementById('getdetails_note').value = res.details_note;
            document.getElementById('getstatus_note').value = res.status_note;
            }
        };
        xhttp.open("GET","/api/notepadgetdata/"+value);
        xhttp.send();
    }
    $('#updated').click(function(){
      swal({
             title:'Updated',
             icon:'success',
             text:'Your Notepad Status Updated...!',
            });      
    })
  
    // Delete Data
    function DeleteDatafromDB(value)
        {swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
              if (willDelete) {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    let res = JSON.parse(this.responseText);
                    console.log(this.responseText);
                    console.log(res);
                    if(res == 1){
                      //-----------
                      swal("Your Data has been deleted!", {
                      title:'Deleted',
                      icon: "success",
                      timer:1000
                    }).then(()=> {
                      window.location.reload();
                    })
                    }
                    else if (res == 0)
                   {
                    swal({
                          title:'Oops',
                          icon:'info',
                          text:'This work is on pending',
                        });
                   }
                   //-------------
              }
            };
            xhttp.open("GET","/api/notepadDeletedata/"+value);
            xhttp.send();
          }
        });
      }
        

</script><?php /**PATH C:\Users\ASUS\Downloads\personal_task_manager-main\resources\views/notepad.blade.php ENDPATH**/ ?>