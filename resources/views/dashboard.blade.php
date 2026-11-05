<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("ようこそ！") }}
                </div>
            </div>
            <div class="mt-4">
                        <a href="{{ route('posts.index') }}" 
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            投稿一覧へ移動する
                        </a>
            </div>
        </div>
    </div>
</x-app-layout>
