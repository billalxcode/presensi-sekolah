import { Alert, AlertDescription } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { SharedData, User, type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { AlertOctagon } from 'lucide-react';
import moment from 'moment';
import { useEffect, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props

    const [currentTime, setCurrentTime] = useState(moment())

    useEffect(() => {
        const currentTimeInterval = setInterval(() => {
            setCurrentTime(moment())
        }, 1000)

        return () => clearInterval(currentTimeInterval)
    }, [])

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Alert variant={"default"}>
                    <AlertOctagon />
                    <AlertDescription>Kamu belum melakukan presensi pulang hari ini</AlertDescription>
                </Alert>
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-auto overflow-hidden rounded-xl border">
                        <Card>
                            <CardHeader>
                                <CardTitle>Waktu Masuk</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="flex items-center justify-center text-4xl font-bold">16:00:00</div>
                            </CardContent>
                        </Card>
                    </div>
                    <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-auto overflow-hidden rounded-xl border">
                        <Card>
                            <CardHeader>
                                <CardTitle>Waktu Pulang</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="flex items-center justify-center text-4xl font-bold">16:00:00</div>
                            </CardContent>
                        </Card>
                    </div>
                    <div className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-auto overflow-hidden rounded-xl border">
                        <Card>
                            <CardHeader>
                                <CardTitle>Profil Kamu</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="flex flex-col gap-2">
                                    <div className="flex flex-row justify-between">
                                        <p>Nama Lengkap: </p>
                                        <p>{ auth.user.name }</p>
                                    </div>
                                    <div className="flex flex-row justify-between">
                                        <p>Kelas: </p>
                                        <p>{ auth.details.kelas?.name ?? "Tidak ada" }</p>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative overflow-hidden rounded-xl border md:min-h-min">
                    <Card>
                        <CardHeader>
                            <CardTitle>Aksi Absen</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="flex gap-2">
                                <Button className='w-full'>Hadir</Button>
                                <Button className='w-full'>Izin</Button>
                                <Button className='w-full'>Sakit</Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppLayout>
    );
}
