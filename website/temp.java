import java.util.*;

class heaps {
    int[] maxheap(int[] heap, int i, int value) {
        heap[i] = value;
        while (i > 1) {
            int parent = i / 2;
            if (heap[parent] < heap[i]) {
                int temp = heap[parent];
                heap[parent] = heap[i];
                heap[i] = temp;
                i = parent;
            } else {
                break;
            }
        }
        return heap;
    }

    int[] sortheap(int arr[]) {
        int N = arr.length;

        for (int i = N / 2 - 1; i > 0; i--)
            arr = heapify(arr, N, i);

        for (int i = N - 1; i > 0; i--) {
            int temp = arr[1];
            arr[1] = arr[i];
            arr[i] = temp;
            System.out.println();
            System.out.println("Node " + arr[i] + " & " + arr[1] + " swapped.");
            System.out.print("[");
            for (int j = 1; j < N; j++) {
                System.out.print(arr[j] + " ");
            }
            System.out.print("]");
            arr = heapify(arr, i, 1);
            System.out.println("\nAfter heapify =>");
            System.out.print("[");
            for (int j = 1; j < N; j++) {
                System.out.print(arr[j] + " ");
            }
            System.out.print("]\n");
        }
        return arr;
    }

    int[] heapify(int heap[], int N, int i) {
        int tempnode = i;

        if (2 * i < N && heap[2 * i] > heap[tempnode])
            tempnode = 2 * i;

        if (2 * i + 1 < N && heap[2 * i + 1] > heap[tempnode])
            tempnode = 2 * i + 1;

        if (tempnode != i) {
            int temp = heap[i];
            heap[i] = heap[tempnode];
            heap[tempnode] = temp;
            heap = heapify(heap, N, tempnode);
        }
        return heap;
    }

}

public class temp {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("Enter total nodes to be inserted :");
        int n = sc.nextInt();
        heaps m1 = new heaps();
        int[] heap = new int[n + 1];
        for (int i = 1; i <= n; i++) {
            System.out.println("Enter node " + i + " : ");
            int val = sc.nextInt();
            heap = m1.maxheap(heap, i, val);
            System.out.print("Max heap : ");
            for (int j = 1; j <= i; j++) {
                System.out.print(heap[j] + " ");
            }
        }

        System.out.println();
        System.out.println("Sorting Starts : ");
        heap = m1.sortheap(heap);
        System.out.println();
        System.out.print("Heap after sorting : ");
        System.out.println();
        System.out.print("[");
        for (int i = 1; i <= n; i++) {
            System.out.print(heap[i] + " ");
        }
        System.out.print("]");
        sc.close();
    }
}