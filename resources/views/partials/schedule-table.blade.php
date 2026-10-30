<div class="overflow-x-auto">
    <table class="w-full whitespace-nowrap text-left text-sm">
        <caption class="sr-only">Vaccination schedules ordered by date</caption>
        <thead class="bg-slate-100 text-xs uppercase tracking-wide text-slate-500">
            <tr>
                <th scope="col" class="px-5 py-4">#</th>
                <th scope="col" class="px-5 py-4">Resident</th>
                <th scope="col" class="px-5 py-4">Address</th>
                <th scope="col" class="px-5 py-4">Vaccine / dose</th>
                <th scope="col" class="px-5 py-4">Date</th>
                <th scope="col" class="px-5 py-4">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($schedules as $schedule)
                <tr @class(['bg-slate-50' => $loop->odd])>
                    <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                    <th scope="row" class="px-5 py-4 font-medium">{{ $schedule->patient_name }}</th>
                    <td class="px-5 py-4 text-slate-500">{{ $schedule->purok }}</td>
                    <td class="px-5 py-4">{{ $schedule->vaccine }}<span class="mt-1 block text-xs text-slate-500">{{ $schedule->dose }}</span></td>
                    <td class="px-5 py-4">{{ $schedule->scheduled_at->format('M d, Y') }}</td>
                    <td class="px-5 py-4">
                        @unless ($schedule->status !== 'Overdue')
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-800">Overdue</span>
                        @endunless
                        @if ($schedule->status === 'Done')
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Done</span>
                        @elseif ($schedule->status !== 'Overdue')
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">{{ $schedule->status }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-slate-500">No schedules yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
