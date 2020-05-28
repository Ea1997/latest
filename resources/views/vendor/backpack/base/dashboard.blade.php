@extends(backpack_view('blank'))

@php
    $userCount = App\User::count();
    $orderCount = App\Order::count();
     $postsCount = App\Post::count();
    $categoriesCount = App\Categorie::count();
    $itemsCount = App\Item::count();
    Widget::add()->to('before_content')->type('div')->class('row')->content([
            // notice we use Widget::make() to add widgets as content (not in a group)
            Widget::make()
                ->type('progress')
                ->class('card border-0 text-white bg-primary')
                ->progressClass('progress-bar')
                ->value($userCount)
                ->description('Nombre utilisateur.')
                ->progress(100*(int)$userCount/1000)
                ->hint(1000-$userCount.' '),
                    Widget::make()
                ->type('progress')
                ->class('card border-0 text-dark bg-default')
                ->progressClass('progress-bar')
                ->value($itemsCount)
                ->description('items creer.')
                ->progress(100*(int)$itemsCount/1000)
                ->hint(1000-$itemsCount.' '),
                    Widget::make()
                ->type('progress')
                ->class('card border-0 text-dark bg-warning')
                ->progressClass('progress-bar')
                ->value($categoriesCount)
                ->description('Created categories.')
                ->progress(100*(int)$categoriesCount/1000)
                ->hint(1000-$categoriesCount.' '),
                    Widget::make()
                ->type('progress')
                ->class('card border-0 text-white bg-dark')
                ->progressClass('progress-bar')
                ->value($postsCount)
                ->description('Created posts.')
                ->progress(100*(int)$postsCount/1000)
                ->hint(1000-$postsCount.' '),



     Widget::make()
                ->type('progress')
                ->class('card w-150 sm-6 border-0 text-white bg-danger  ')
                ->progressClass('progress-bar')
                ->value($orderCount)
                ->description('Orders made.')
                ->progress(100*(int)$orderCount/1000)
                ->hint(1000-$orderCount.' A ajouter'),

                Widget::make([
    'type'       => 'chart',
    'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,
    'class' => 'col-sm-17',
    // OPTIONALS
]),


 Widget::make([
    'type'       => 'chart',
    'controller' => \App\Http\Controllers\Admin\Charts\NewEntriesChartController::class,
    'class' => 'col-sm-17',
    ])
]);
   // 'class'   => 'card mb-2',
     //'wrapper' => ['class'=> 'col'] ,
    //'content' => [
      //    'header' => 'New Users',
      //    'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
    // ],





   //  Widget::add()->to('before_content')->type('div')->class('row')->content([

    // OPTIONALS

   //  'class'   => 'card mb-2',
    //'wrapper' => ['class'=> 'col-1'] ,
     //'content' => [
     //     'header' => 'New Users',
      //    'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
    // ],
//]),




        // OPTIONALS

        // 'class'   => 'card mb-2',
        // 'wrapper' => ['class'=> 'col-md-6'] ,
        // 'content' => [
             // 'header' => 'New Users',
             // 'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',


@endphp

@section('content')
@endsection
