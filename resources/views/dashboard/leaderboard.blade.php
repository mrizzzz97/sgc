@extends('layouts.dashboard')

@section('title', 'Leaderboard — ' . $module->title)

@section('content')
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 dark:text-white">
        Leaderboard — {{ $module->title }}
    </h1>

    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6">

        <table class="w-full text-left">
            <thead>
                <tr class="border-b dark:border-gray-700">
                    <th class="py-2">Peringkat</th>
                    <th>Nama</th>
                    <th>Rata-rata Nilai</th>
                    <th>Chapter Lulus</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($leaderboard as $index => $row)
                <tr class="border-b dark:border-gray-700">
                    <td class="py-2 font-semibold">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $users[$row->user_id]->name ?? 'Unknown' }}
                    </td>

                    <td>{{ round($row->avg_score) }}%</td>

                    <td>{{ $row->passed_count }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Belum ada peserta.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div class="mt-4">
        <a href="{{ route('murid.modules.show', $module->id) }}" 
           class="text-blue-500 underline">Kembali ke Modul</a>
    </div>

</div>
@endsection
