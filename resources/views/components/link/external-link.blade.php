@props(['href' => '#', 'target' => '_blank'])

<a onclick="window.open('{{$href}}', '_blank', 'location=yes,height=1200,width=800,scrollbars=yes,status=yes');"
    {{ $attributes->class(['cursor-pointer hover:text-white  hover:bg-gradient-to-t from-[#009254]  to-[#94C45B] border border-[#009254] text-gray-700 inline-flex cursor-pointer items-center px-2 py-1  rounded-md shadow-sm hover:shadow-md duration-800 text-xs font-medium transition-all']) }}>
    {{ $slot }}
</a>
