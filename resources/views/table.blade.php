<x-layouts.app>

  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.all.min.css') }}" />
  <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href=" {{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="{{ asset('assets/js/font-awesome42d5adcbca.js') }}" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  {{-- <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script> --}}
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
  {{-- <link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet"> --}}

  {{-- <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script> --}}
  <link rel="stylesheet" href="{{ asset('assets/css/dataTables.dataTables.css') }}">
  {{-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script> --}}

  <link rel="stylesheet" href="{{ asset('assets/css/buttons.bootstrap5.css') }}">



  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.buttons.js') }}"></script>
  <script src="{{ asset('assets/js/buttons.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>

  <style>
    .d-flex {
      gap: 20px;
    }

    .dropdown-container {
      display: flex;
      margin-top: 10px;
      gap: 25px;
      flex-direction: column;
      color: #37517e;
      background-color: #fff;
      position: absolute;
      top: 50px;
      border-radius: 10px;
      padding: 15px 15px 0 15px;
      /* max-height: 220px; */
      right: 30px;
      width: 150px;
      z-index: 9999;
      opacity: 0;
      visibility: hidden;
      transition: 0.3s ease all;
      box-shadow: 7px 20px 37px -11px rgba(0, 0, 0, 0.75);
      -webkit-box-shadow: 7px 20px 37px -11px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: 7px 20px 37px -11px rgba(0, 0, 0, 0.75);
    }

    .icon-profile {
      width: 20px;
      height: 20px;
    }



    .dropdown-container.active {
      visibility: visible;
      opacity: 1;
    }

    .link-item {
      font-size: 15px;
      color: black;
    }
  </style>

  <div class="card p-4 mx-3">
    <style>
      input#dt-search-0 {
        border-radius: 30px;
      }

      input#dt-search-0:focus {
        text-indent: 15px;
      }

      .text-indent-1 {
        text-indent: 10px;
      }

      .dt-buttons {
        gap: 10px;
      }

      .dt-search {
        position: absolute;
        right: 0;
        top: 0;
        margin-bottom: 10px;
      }

      .dropdown-menu.dt-button-collection {
        overflow: visible;

        /* background-color: black; */
      }

      @media only screen and (max-width: 600px) {
        .dt-search {
          position: static;
        }
      }

      .dt-paging-button.page-item.active .page-link {
        color: white !important;
      }

      .dt-paging-button.page-item.active:hover {
        background-color: white !important;
        box-shadow: none;
      }
    </style>



    @isset($modal_title['tambah'])
      @if ($modal_title['tambah'] == 'link')
        <a href="{{ route('lt.home') }}" class="btn btn-primary btn-simple p-2 w-lg-20">
          {{ __('Add') }}
        </a>
      @else
        <button type="button" class="btn btn-secondary btn-simple p-2 w-lg-20" data-bs-toggle="modal"
          data-bs-target="#modal-tambah">
          {{ $modal_title['tambah'] }}
        </button>
      @endif
    @endisset


    <div class="table-responsive">
      @if ($message = Session::get('success'))
        <div class="alert alert-secondary alert-block text-center text-white">
          <button type="button" class="close" data-dismiss="alert" class="">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @endif

      @if ($message = Session::get('fail'))
        <div class="alert alert-secondary alert-block text-center text-white">
          <button type="button" class="close" data-dismiss="alert" class="">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @endif


      <table id="example" class="display table align-items-center mb-0" style="width:100%">
        <thead>
          <tr>

            <th class="text-uppercase text-black text-xs font-weight-bolder text-center">No.</th>

            @foreach ($cols as $col)
              <th class="text-uppercase text-black text-xs font-weight-bolder text-center">{{ $col }}</th>
            @endforeach

            @if (!empty($modal_title['edit']) || !empty($modal_title['delete']))
              <th class="text-uppercase text-black text-xs font-weight-bolder text-center">action</th>
            @endif
          </tr>
        </thead>
        <tbody>
          <?php
              $no = 1;
              foreach ($dataTables  as $data) {

              ?>
          <tr>
            <td class=" text-center"><?= $no ?></td>

            @foreach ($rows as $row)
              @isset($row[1])
                @if ($row[1] == 'image')
                  <div class="d-flex justify-content-center mx-auto">
                    <td class="">
                      <?php if (isset($data[$row[0]]) && strlen($data[$row[0]]) > 1) { ?>
                      <img class="img-thumbnail" width="100" height="100" alt="<?= $data[$row[0]] ?>" src="#"
                        <?php } else
                      { ?> <p>Kosong</p>
                      <?php } ?>
                    </td>
                  </div>
                @elseif ($row[1] == 'file')
                  <td class="text-wrap text-center">
                    @if (!empty($data[$row[0]]))
                      <a href="/storage{{ $data[$row[2]] }}/{{ $data[$row[0]] }}">Download File</a>
                    @else
                      <p>Kosong</p>
                    @endif
                  </td>
                @else
                  <td class="text-wrap text-center"><?= $data[$row] ?></td>
                @endif
              @endisset
            @endforeach

            @if (!empty($modal_title['edit']) || !empty($modal_title['delete']))
              <td class="">

                <?php if ($btn_link) { ?>
                {{-- <button type="button" class="btn btn-warning btn-simple p-2" onclick="">
                  {{ $btn_link_name }}
                </button> --}}
                <a href="<?= $btn_link ?>/<?= $data['id'] ?>" type="button" class="btn btn-warning btn-simple p-2">
                  <?= $btn_link_name ?>
                </a>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <script></script>
                <?php } else { ?>
                <?php if (isset($modal_title['edit'])) { ?>

                <button type="button" class="btn btn-warning btn-simple p-2" data-bs-toggle="modal"
                  data-bs-target="#modal-edit<?= $data['id'] ?>">
                  Edit
                </button>
                <?php } ?>
                <?php } ?>
                <?php if (isset($modal_title['delete'])) { ?>
                <button type="button" class="btn btn-danger btn-simple p-2" data-bs-toggle="modal"
                  data-bs-target="#modal-delete<?= $data['id'] ?>">
                  Delete
                </button>
                <?php } ?>

                {{-- Third Button --}}
                @isset($modal_title['forward'])
                  <button type="button" class="btn btn-success btn-simple p-2" data-bs-toggle="modal"
                    data-bs-target="#modal-forward<?= $data['id'] ?>">
                    Forward
                  </button>
                @endisset
              </td>
            @endif
          </tr>

          @isset($third_button)
            <!-- Modal Forward-->
            <div class="modal fade" id="modal-forward<?= $data['id'] ?>" tabindex="-1" role="dialog"
              aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card card-plain">
                      <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">
                          <?= isset($modal_title['forward']) ? $modal_title['forward'] : '' ?></h3>
                      </div>
                      <div class="card-body">
                        <form role="form text-left"
                          action="{{ isset($third_button['link']) ? route($third_button['link']) : '' }}" method="POST"
                          enctype="multipart/form-data">
                          {{-- <form role="form text-left" wire:submit="update"> --}}
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" name="id" value="<?= $data['id'] ?>">


                          <?php foreach ($modal_third_button as $row) {
                            $name =  $row['name'];
                            $label =  ucfirst(str_replace(["_", 'id'], " ", $row['name']));
                            ?>
                          <label> <?= $label ?> </label>
                          <div class="input-group mb-3">
                            <?php if (!empty($row['type']) && $row['type'] == 'textarea') { ?>
                            <textarea type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" wire:model="{{ $row['model'] }}" rows="8"
                              cols="50" class="form-control" name="<?= $name ?>"><?= $data[$name] ?></textarea>
                            <?php } elseif (!empty($row['type']) && $row['type'] == 'select') {
                                  ?>
                            <select class="form-control" name="<?= $name ?>" wire:model="{{ $row['model'] }}">
                              @foreach ($row['options'] as $key)
                                @isset($key['name'])
                                  <option {{ $key['name'] == $data[$name] ? 'selected' : '' }}
                                    value=" {{ $key['id'] }}">
                                    {{ $key['name'] }} </option>
                                @else
                                  <option {{ $key == $data[$name] ? 'selected' : '' }} value=" {{ $key }}">
                                    {{ $key }} </option>
                                @endisset
                              @endforeach
                            </select>
                            <?php } else {
                                    if (!empty($row['type']) && $row['type'] == 'file') { ?>
                            <input type="hidden" name="path" value="<?= $data[$name] ?>">
                            <?php }
                                    ?>
                            <input type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" class="form-control"
                              name="<?= $name ?>" value="{{ $data[$name] }}" placeholder="{{ $data[$name] }}">
                            <?php } ?>
                          </div>
                          <?php } ?>


                          <div class="text-center">
                            <button type="submit"
                              class="btn btn-sm bg-success text-white">{{ $third_button['name'] }}</button>
                            <button type="button" class="btn btn-sm bg-secondary text-white"
                              data-bs-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endisset

          <!-- Modal Edit -->
          <div class="modal fade" id="modal-edit<?= $data['id'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                      <h3 class="font-weight-bolder text-info text-gradient">
                        <?= isset($modal_title['edit']) ? $modal_title['edit'] : '' ?></h3>
                    </div>
                    <div class="card-body">
                      <form role="form text-left" action="{{ route($base_route) }}" {{-- action="{{ isset($delete_link) || isset($base_route) ? (isset($resource) ? route($base_route) . '/' . $data['id'] : route($delete_link)) : '' }}" --}}
                        method="POST">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{ $data['id'] }}">


                        <?php foreach ($modal_field as $row) {
                            $name =  $row['name'];
                            $model_s = $row['model'];
                            if (isset($row['editSelected'])) {
                              $selected = $row['editSelected'];
                            }
                            $label =  ucfirst(str_replace(["_", 'id'], " ", $row['name']));
                            ?>
                        <label> <?= $label ?> </label>
                        <div class="input-group mb-3">
                          <?php if (!empty($row['type']) && $row['type'] == 'textarea') { ?>
                          <textarea type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" value="{{ $data[$row['model']] }}"
                            rows="8" cols="50" class="form-control" name="<?= $name ?>"><?= $data[$name] ?></textarea>
                          <?php } elseif (!empty($row['type']) && $row['type'] == 'select') {

                                      ?>
                          <select class="form-control" name="<?= $name ?>" value="{{ $data[$row['model']] }}">
                            @foreach ($row['options'] as $key)
                              @isset($key['name'])
                                <option {{ $key['name'] == $data[$selected] ? 'selected' : '' }}
                                  value=" {{ $key['id'] }}">
                                  {{ $key['name'] }} </option>
                              @else
                                <option {{ $key == $data[$name] ? 'selected' : '' }} value=" {{ $key }}">
                                  {{ $key }} </option>
                              @endisset
                            @endforeach
                          </select>
                          <?php } else {
                                    if (!empty($row['type']) && $row['type'] == 'file') { ?>
                          <input type="hidden" name="path" value="<?= $data[$name] ?>">
                          <?php }
                                    ?>
                          <input type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" class="form-control"
                            name="<?= $model_s ?>" value="{{ $data[$model_s] }}"
                            placeholder="{{ $data[$model_s] }}">
                          <?php } ?>
                        </div>
                        <?php } ?>


                        <div class="text-center">
                          <button type="submit" class="btn btn-sm bg-success text-white">Update</button>
                          <button type="button" class="btn btn-sm bg-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Delete -->
          <div class="modal fade" id="modal-delete<?= $data['id'] ?>" tabindex="-1" role="dialog"
            aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <?php if (isset($modal_title['delete'])) { ?>
                  <h6 class="modal-title" id="modal-title-default"><?= $modal_title['delete'] ?></h6>
                  <?php } ?>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p><?= $delete_msg ?></p>
                </div>
                <div class="modal-footer">
                  <form role="form text-left" action="{{ route($base_route) }}" {{-- action="{{ isset($delete_link) || isset($base_route) ? (isset($resource) ? route($base_route) . '/' . $data['id'] : route($delete_link)) : '' }}" --}}
                    method="POST">
                    @method('DELETE')
                    @csrf

                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <?php
                          foreach ($rows as $row) {

                            if (isset($row[1]) && $row[1] == 'image') { ?>
                    <input type="hidden" name="path" value="assets/portfolio/<?= $data[$row[0]] ?>">
                    <?php }
                          }
                          ?>
                    <button type="submit" class="btn bg-gradient-primary">Delete</button>
                  </form>
                  <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <?php
                $no++;
              } ?>
        </tbody>
      </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-form"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <?php if (isset($modal_title['tambah'])) { ?>
                <h3 class="font-weight-bolder text-info text-gradient"><?= $modal_title['tambah'] ?></h3>
                <?php } ?>
              </div>
              <div class="card-body">
                <form role="form text-left" action="" method="POST" enctype="multipart/form-data">
                  <?= csrf_field() ?>

                  <?php foreach ($modal_field as $row) {
                        $name =  $row['model'];
                        $label =  ucfirst(str_replace(["_", 'id'], " ", $row['name']));
                        if (!empty($row['type'])) {
                          if ($row['type'] != 'hidden') {
                            echo  '<label>' . $label . '</label>';
                          }
                        } else {
                          echo  '<label>' . $label . '</label>';
                        }
                      ?>

                  <div class="input-group mb-3">
                    <?php if (!empty($row['type']) && $row['type'] == 'textarea') { ?>
                    <textarea type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" rows="8" cols="50"
                      class="form-control" name="<?= $name ?>"></textarea>
                    <?php } elseif (!empty($row['type']) && $row['type'] == 'select') {
                          ?>

                    <select class="form-control" name="<?= $name ?>">
                      @foreach ($row['options'] as $key)
                        @isset($key['name'])
                          <option {{ $key['name'] == 3 ? 'selected' : '' }} value=" {{ $key['id'] }}">
                            {{ $key['name'] }} </option>
                        @else
                          <option {{ $key == 3 ? 'selected' : '' }} value=" {{ $key }}">
                            {{ $key }} </option>
                        @endisset
                      @endforeach
                    </select>
                    <?php } else { ?>
                    <input type="<?= empty($row['type']) ? 'text' : $row['type'] ?>" class="form-control"
                      name="<?= $name ?>">
                    <?php } ?>
                  </div>
                  <?php } ?>


                  <div class="text-center">
                    <button type="submit" class="btn btn-sm bg-success text-white">Tambah</button>
                    <button type="button" class="btn btn-sm bg-secondary text-white"
                      data-bs-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
      $('#iconNavbarSidenav').on('click', (e) => {
        e.preventDefault()
        $('body').toggleClass('g-sidenav-pinned');
      })

      $('#avatar-dropdown').on('click', (e) => {
        $('.dropdown-container').toggleClass('active');
      })
    </script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    <script>
      const Swal = require('sweetalert2')
    </script>


    <script>
      $('#example').DataTable({
        //   dom: 'Blfrtip',
        pageLength: 5,
        lengthMenu: [
          [5, 10, 20],
          [5, 10, 20]
        ],
        layout: {
          topStart: {
            buttons: [

              //   {
              //     extend: 'copyHtml5',
              //     exportOptions: {
              //       columns: [0, ':visible']
              //     }
              //   },
              {
                extend: 'excelHtml5',
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'pdfHtml5',
                exportOptions: {
                  columns: ':visible'
                }
              },
              'colvis'
            ]
          },

        }
      });
      $('.close').on('click', () => {
        $('.alert').remove()

      })

      $('#dt-length-0').removeClass();
      $('#dt-search-0').removeClass();
    </script>
  </div>


</x-layouts.app>
