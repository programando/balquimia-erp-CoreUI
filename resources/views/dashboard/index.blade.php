@extends('adminCoreUI.index')

@section('content')

   <template v-if="IdMenu==0">
      <ejemplo></ejemplo>
   </template>

    <template v-if="IdMenu==1">
      <ejemplo2></ejemplo2>
   </template>

@endsection
