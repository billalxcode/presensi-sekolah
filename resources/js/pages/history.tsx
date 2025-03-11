import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import AppLayout from "@/layouts/app-layout";
import { BreadcrumbItem } from "@/types";
import { Head } from "@inertiajs/react";
import moment from "moment";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: "History",
        href: "/history"
    }
]

export default function History() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="History" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <Card className="border-sidebar-border/70 dark:border-sidebar-border relative flex-1 overflow-hidden rounded-xl border md:min-h-min">
                    <CardHeader>
                        <CardTitle>Riwayat</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableCaption>Riwayat absensi</TableCaption>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Keterangan</TableHead>
                                    <TableHead>Waktu</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow>
                                    <TableCell>
                                        <Badge variant={"success"}>Masuk</Badge>
                                    </TableCell>
                                    <TableCell>
                                        Tidak ada keterangan
                                    </TableCell>
                                    <TableCell>
                                        { moment().toISOString() }
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    )
}
