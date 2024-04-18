<x-header-admin/>
    <div class="bloks_wrapper">
        @if(Session::has('success'))
            <div class="message-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="message-error">
                {{ Session::get('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="message-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <div class="block_container">
                    <h2 class="admin_title">Пользователи</h2>
                    <?php
                        if($count > 0) {
                            
                    ?>
                    <table class="admin_table table_categories">
                        <thead>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                            @foreach($data as $el)
                                <tr>
                                    <td>{{$el->name}}</td>
                                    <td>{{$el->email}}</td>
                                    <td><a href="{{route('admin-users-delete',$el->id)}}" class="table_link link_delete">Удалить</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <?php
                        $page_count = ceil($count / 20);
                        if($page_count > 1) {
                            echo "<div class='block_container'><div class='pagination_wrapper'>";
                            echo "<a href='/admin-users/0' class='pagination_link'><<</a>";
                            $currentPage = $page + 1;
                            $start = max($currentPage - 3, 1);
                            $end = min($currentPage + 3, $page_count);
                            for ($i = $start; $i <= $end; $i++) {
                                $p = $i - 1;
                                $pag_class = ($page == $p) ? "pagination_link-active" : "pagination_link";
                                echo "<a href='/admin-users/$p' class='$pag_class'>$i</a>";
                            }
                            echo "<a href='/admin-users/" . ($page_count - 1) . "' class='pagination_link'>>></a>";
                            echo "</div></div>";
                        }
                    ?>
            <?php
                } 
            ?>
    </div>
<x-footer-admin/>